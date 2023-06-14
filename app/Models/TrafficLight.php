<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrafficLight extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function appeals()
    {
        return $this->hasMany(Appeal::class);
    }
}
