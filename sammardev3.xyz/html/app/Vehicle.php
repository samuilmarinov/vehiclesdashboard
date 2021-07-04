<?php

namespace App;
use Carbon;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'version', 'status', 'info', 'brand_id', 'model_id', 'bodywork_id', 'engine_id', 'color_id', 'image', 'imageurl'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    // protected $primaryKey = 'brand_id';

    public function vehiclecolor()
    {
        return $this->hasOne(Color::class);
    }

    public function vehiclebrand()
    {
        return $this->hasOne(Brand::class);
    }

    public function vehiclemodel()
    {
        return $this->hasOne(VehicleModel::class);
    }

    public function vehicleengine()
    {
        return $this->hasOne(Engine::class);
    }

    public function vehiclebodywork()
    {
        return $this->hasOne(Bodywork::class);
    }

    public function scopeBetween($query, Carbon $from_date, Carbon $to_date)
    {
        $query->whereBetween('created_at', [$from_date, $to_date]);
    }

}
