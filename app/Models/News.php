<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class News extends Model
{
    use HasFactory,softDeletes;

    protected $table = "tb_news";
    protected $id = "id";

    public function Category()
    {
        return $this->belongsTo('App\Models\Category', 'id_category');
        // return $this->hasOne(Phone::class, 'foreign_key');
        // return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
    }
   
}
