<?php

namespace App\Models;

use App\Enums\AppealStatus;
use App\Enums\TypeOfCrash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appeal extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'status' => AppealStatus::class,
        'type_of_crash' => TypeOfCrash::class,
    ];

    public function trafficLight()
    {
        return $this->belongsTo(TrafficLight::class);
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id', 'id');
    }

    public function engineer()
    {
        return $this->belongsTo(User::class, 'engineer_id', 'id');
    }
}
