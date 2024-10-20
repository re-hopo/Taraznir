<?php

namespace Modules\Theme\app\Livewire\Widgets;

use Illuminate\View\View;
use Livewire\Component;

class InfoListWidget extends Component
{
    public ?string $title = '';
    public ?array $items  = [];

    public function mount($title = '' ,$items= []): void
    {
        $this->title = $title;
        $this->items = $items;
    }


    public function render(): View
    {
        return view('theme::widgets.info-list-widget');
    }
}
