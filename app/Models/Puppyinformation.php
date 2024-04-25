<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puppyinformation extends Model
{
    use HasFactory;
    protected $fillable = ['coat_type','sheeding'];

    public $timestamps = false;
}
