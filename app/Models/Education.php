<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_name',
        'order',
        'start_year',
        'end_year',
        'jurusan',
        'link',
    ];
}
