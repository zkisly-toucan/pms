<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $appends = ['owner', 'secrets'];

    public function owner(){
        return $this->belongsTo('App\User');
    }

    public function secrets(){
        return $this->hasMany('App\Models\Secret', 'group_id', 'id');
    }

    protected function getOwnerAttribute(){
        $this->owner();
    }

    protected function getSecretsAttribute(){
        return $this->secrets();
    }
}
