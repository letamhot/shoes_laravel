<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bills extends Model
{
    use SoftDeletes;

    protected $table = 'bills';
    protected $primaryKey = 'id';

    protected $fillable = ['id_customer', 'date_order', 'total', 'payment', 'status', 'user_deleted'];

    protected $dates = ['deleted_at'];

    public function customer()
    {
        return $this->belongsTo("App\Customer", 'id_customer', 'id')->withTrashed();
    }


    public function bill_detail()
    {
        return $this->hasMany("App\Bill_detail", 'id_bill', 'id')->withTrashed();
    }
}