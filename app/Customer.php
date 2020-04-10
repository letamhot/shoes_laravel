<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customer';
    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_deleted'];

    public function bills()
    {
        return $this->hasMany("App\Bills", 'id_customer', 'id');
    }

    public function bills_trash()
    {
        return $this->hasMany("App\Bills", 'id_customer', 'id')->withTrashed();
    }
}