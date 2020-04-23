<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';

    protected $primaryKey = 'id';

    public function product()
    {
        return $this->belongsTo("App\Product", 'id_product', 'id')->withTrashed();
    }
}
