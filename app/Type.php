<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';
    protected $primaryKey = 'id';
    public function product()
    {
        return $this->hasMany(Product::class, 'id_type', 'id');
    }
}