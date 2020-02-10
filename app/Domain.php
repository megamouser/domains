<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $guarded = [];

    public function options()
    {
        return $this->belongsToMany(Option::class)->withTimestamps();
    }  
}
