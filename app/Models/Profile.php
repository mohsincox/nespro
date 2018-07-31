<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = [
    						'phone_number',
    						'agent',
    						'consumer_name',
    						'consumer_age',
    						'consumer_gender',
    						'division',
    						'district',
    						'police_station',
    						'address',
    						'alternative_phone_number',
    						'profession',
    						'sec',
    						'number_of_child',
    						'total_family_member',
    						'child1_DOB',
    						'child2_DOB',
    						'child3_DOB',
    						'prefered_brand',
    						'created_by',
    						'updated_by',
    						'deleted_by',
    						'deleted_at'
    					];
}
