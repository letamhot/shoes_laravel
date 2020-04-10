<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill_detail extends Model
{
    use SoftDeletes;

    protected $table = 'bills_detail';
    protected $primaryKey = 'id';

    protected $fillable = ['id_bill', 'id_product', 'name_product', 'size', 'quantity', 'unit_price', 'total_price', 'status', 'user_deleted', 'discount'];

    protected $dates = ['deleted_at'];

    //Update datetime to table categories
    protected $touches = ['bills'];

    public function bills()
    {
        return $this->belongsTo("App\Bills", 'id_bill', 'id')->withTrashed();
    }

    public function product()
    {
        return $this->belongsTo("App\Product", 'id_product', 'id')->withTrashed();
    }
}