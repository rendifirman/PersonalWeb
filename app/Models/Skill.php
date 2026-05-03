<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name', 'type', 'percentage'];

    public function scopeSoft($query)
    {
        return $query->where('type', 'soft');
    }

    public function scopeHard($query)
    {
        return $query->where('type', 'hard');
    }
}
