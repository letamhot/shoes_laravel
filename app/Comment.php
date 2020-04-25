<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class Comment extends Model
{
    use Commentable;
    protected $table = 'comments';

    protected $primaryKey = 'id';
    public function user()
    {
        return $this->belongsTo(User::class, 'commenter_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'commentable_id', 'id');
    }
}