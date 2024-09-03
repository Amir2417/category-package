<?php

namespace Jatri\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts    = [
        'slug'          => 'string',
        'name'          => 'string'
    ];
}
