<?php

namespace Modules\Tutorial\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use LakM\Comments\Concerns\Commentable;
use LakM\Comments\Contracts\CommentableContract;
use Modules\Core\app\Traits\CommonModelMethodsTrait;
use Modules\Core\app\Traits\CommonScopesTrait;
use Modules\Tutorial\Database\factories\TutorialFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;

class Tutorial extends Model implements HasMedia, CommentableContract
{
    use CommonScopesTrait ,CommonModelMethodsTrait ,HasRoles ,Commentable;

    protected $appends = ['images'];

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'status',
        'chosen',
        'author_id',
    ];


    protected static function newFactory(): TutorialFactory
    {
        return TutorialFactory::new();
    }


    public function courses():HasOne
    {
        return $this->hasOne(TutorialCourses::class);
    }


    public function tutorialCourses():HasMany
    {
        return $this->hasMany(TutorialCourses::class);
    }

}
