<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /*protected $hidden = ['title','body'];
    protected $appends = ['post_name','post_excerpt'];

    public function getPostNameAttribute() {
        return strtoupper($this->title);
    }

    public function getPostExcerptAttribute() {
        return strtoupper(
            substr($this->body,0,100) . '...'
        );
    }*/
}
