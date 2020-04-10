<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size_product extends Model
{
    public $table = 'size_product';
    protected $primaryKey = 'id';

    public function product()
    {
        return $this->belongsTo("App\Product", 'id_product', 'id');
    }

    public function size()
    {
        return $this->belongsTo("App\Size", 'id_size', 'id');
    }
}