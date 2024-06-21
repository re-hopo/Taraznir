<?php

namespace Modules\Core\app\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{

    protected $fillable = [
        'key',
        'value',
    ];

    protected  $table = 'meta';
    public $timestamps = false;

}
