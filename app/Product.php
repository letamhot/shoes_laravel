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

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_deleted'];

    public function producer()
    {
        return $this->belongsTo(Producer::class, 'id_producer', 'id')->withTrashed();
    }
    public function reviews()
    {
        return $this->hasMany("App\Review", 'id_product', 'id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'id_type', 'id')->withTrashed();
    }
    public function bill_detail()
    {
        return $this->hasMany("App\Bill_detail", 'id_product', 'id')->withTrashed();
    }

    public function size()
    {
        return $this->belongsToMany(Size::class, 'size_product', 'id_product', 'id_size');
    }

    public function size_product()
    {
        return $this->hasMany(Size_product::class, 'id_product', 'id');
    }
}