<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected  $fillable = [
        'title',
        'content',
        'slug',
        'meta_description',
        'meta_keywords',
        'image',
    ];
}
