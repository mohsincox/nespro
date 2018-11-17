<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = ['phone_number', 'consumer_name', 'address', 'activity_campaign_name', 'activity_date', 'agent'];

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function policeStation()
    {
        return $this->belongsTo(PoliceStation::class, 'police_station_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
