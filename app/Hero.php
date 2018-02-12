<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
	protected $fillable = [
        'name', 'alter_ego','likes','default_hero'
    ];
}
