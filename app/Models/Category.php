<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "tb_category";

    protected $id = "id";
    public function news()
    {
        // return $this->belongsTo('App\Models\Category', 'id_category');
        // return $this->hasOne(Phone::class, 'foreign_key');
        return $this->hasMany('App\Models\News', 'id_category');
    }
}

