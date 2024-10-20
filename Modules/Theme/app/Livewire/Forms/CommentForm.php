<?php

namespace Modules\Theme\app\Livewire\Forms;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Core\app\Models\Comment;
use Modules\Core\app\Traits\CommonAlert;
use Modules\Theme\app\Livewire\Components\CommentList;

class CommentForm extends Component
{
    use CommonAlert;

    public ?string $message = '';
    public ?string $email   = '';
    public ?string $name    = '';
    public ?string $mobile  = '';
    public ?int $parent_id  = 0;
    public ?string $model   = '';
    public ?int $postID;
    public ?bool $hasTitle;
    public array $rules = [];

    public function mount($model ,$id ,$title = true): void
    {
        $this->model    = $model;
        $this->postID   = $id;
        $this->hasTitle = $title;

        $require = 'required';
        if(auth()->check())
            $require = 'nullable';

        $this->rules = [
            'email'   => "$require|email",
            'name'    => "$require|min:2|max:50",
            'mobile'  => "$require|min:10|max:13",
            'message' => "required|min:3|max:1000",
        ];
    }


    #[On('set-parent-id')]
    public function setParentId($parentID): void
    {
        $this->parent_id = $parentID;
    }

    public function getParentName()
    {
        return Comment::find($this->parent_id)
            ->user
            ?->name;
    }

    public function cancelReply(): void
    {
         $this->parent_id = 0;
    }

    public function submit(): string
    {

        $this->validate($this->rules);

        $status = Comment::create([
            'commentable_type' => $this->model,
            'commentable_id'   => $this->postID,
            'body'             => $this->message,
            'parent_id'        => $this->parent_id,
            'user_id'          => auth()->id(),
        ]);

        if( $status ){
            $this->parent_id = 0;
            $this->message   = '';

            $this->dispatch('$refresh')->to(CommentList::class);
            return $this->topRightToast(
                __('theme::theme.alert.successfully_stored')
            );
        }

        return $this->topRightToast(
            __('theme::theme.alert.failed_stored'), 'error'
        );
    }


    public function render(): View
    {
        return view('theme::components.comment.comment-form');
    }
}
