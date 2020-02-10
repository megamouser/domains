<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = [];

    public function domain()
    {   
        return $this->hasOne(Domain::class);
    }
}
