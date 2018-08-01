<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crm extends Model
{
    protected $table = 'crms';

    public function profile()
    {
    	return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function brand()
    {
    	return $this->belongsTo(Brand::class, 'brand_id');
    }
}
