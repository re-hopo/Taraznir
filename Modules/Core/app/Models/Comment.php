<?php

namespace Modules\Core\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\app\Models\User;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'commentable_type',
        'commentable_id',
        'user_id',
        'post_id',
        'parent_id',
        'body'
    ];

    public function children(): HasMany
    {
        return $this->hasMany(Comment::class ,'parent_id' ,'id')
            ->with(['children' ,'user']);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
