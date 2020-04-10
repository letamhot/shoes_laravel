<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes;

    protected $table = 'type';
    protected $primaryKey = 'id';
    public function product()
    {
        return $this->hasMany(Product::class, 'id_type', 'id');
    }
}