<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    protected $fillable = [
        'name',
        'benefits',
        'required_tasks',
        'badge',
        'days_threshold',
        'default'
    ];

    protected function casts(): array
    {
        return [
            'default' => 'boolean',
        ];
    }
}
