<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';

    protected $primaryKey = 'id';

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }
}