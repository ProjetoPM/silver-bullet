<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    public $table = 'projects';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const VISIBILITY_RADIO = [
        '0' => 'Público',
        '1' => 'Privado',
    ];

    protected $fillable = [
        'title',
        'objectives',
        'visibility',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];
}
