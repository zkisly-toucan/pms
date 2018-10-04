<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $appends = ['owner'];

    public function owner(){
        return $this->belongsTo('App\User');
    }

    protected function getOwnerAttribute(){
        $this->owner();
    }
}
