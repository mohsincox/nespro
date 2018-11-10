<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = ['phone_number', 'consumer_name', 'address', 'activity_campaign_name', 'agent'];

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
}
