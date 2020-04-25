<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageCenter extends Model
{
    protected $table = 'message_center';

    protected $primaryKey = 'id';

    public function bills()
    {
        return $this->belongsTo("App\Bills", 'id_bill', 'id')->withTrashed();
    }

    public function reivews()
    {
        return $this->belongsTo("App\Reviews", 'id_review', 'id');
    }
}