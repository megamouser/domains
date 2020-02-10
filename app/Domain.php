<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $guarded = [];

    public function options()
    {
        $this->hasMany(Option::class);
    }
}
