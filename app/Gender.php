<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Gender extends Model
{
    use SoftDeletes;

    protected $table = 'gender';
    protected $primaryKey = 'id';

    public function customer()
    {
        return $this->hasMany(Customer::class, 'gender_id', 'id');
    }
    public function user()
    {
        return $this->hasMany("App\User", 'gender_id', 'id');
    }
}