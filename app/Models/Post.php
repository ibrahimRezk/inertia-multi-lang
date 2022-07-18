<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;


class Post extends Model
{
    use HasFactory;
    use Translatable;


    public $translatedAttributes = ['name'];
    public $guarded = [];



}
