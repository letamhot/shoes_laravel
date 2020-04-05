<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    protected $table = 'producer';
    protected $primaryKey = 'id';
    // public $timestamps = false;

    public function product()
    {
        return $this->hasMany(Product::class, 'id_producer', 'id');
    }
}