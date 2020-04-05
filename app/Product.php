<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravelista\Comments\Commentable;

class Product extends Model
{
    use SoftDeletes;
    use Commentable;

    protected $table = 'product';

    public function producer()
    {
        return $this->belongsTo(Producer::class, 'id_producer', 'id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'id_type', 'id');
    }
}