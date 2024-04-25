<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class puppy_overview extends Model
{
    use HasFactory;
    protected $fillable = ['cover_image','page_title'];
    public $timestamps = false;
}
