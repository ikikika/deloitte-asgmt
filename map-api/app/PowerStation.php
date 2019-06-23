<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PowerStation extends Model
{
    protected $fillable = ['name', 'longitude', 'latitude'];
}
