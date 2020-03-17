<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = [];

    // public function domains()
    // {   
    //     return $this->belongsToMany(Domain::class)->withTimestamps();
    // }

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
