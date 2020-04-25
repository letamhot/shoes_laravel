<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Review extends Model
{
    use Rateable;
    protected $table = 'review';

    protected $primaryKey = 'id';

    public function product()
    {
        return $this->belongsTo("App\Product", 'id_product', 'id')->withTrashed();
    }
    public function message()
    {
        return $this->hasMany("App\MessageCenter", 'id_review', 'id');
    }
}