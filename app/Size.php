<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'size';

    protected $primaryKey = 'id';

    public function product()
    {
        return $this->belongsToMany(Product::class, 'size_product', 'id_product', 'id_size');
    }

    public function size_product()
    {
        return $this->hasMany("App\Size_product", 'id_size', 'id');
    }
}