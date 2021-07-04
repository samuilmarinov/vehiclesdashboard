<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    protected $fillable = [
        'name', 'brand_id', 'status'
    ];
  
    // protected $primaryKey = 'brand_id';

    function vehiclemodel() {
        return $this->belongsTo('vehicles', 'model_id');
    }
    
    public function vehiclebrand() {
        return $this->hasMany('vehicles', 'brand_id');
    }
    
}
