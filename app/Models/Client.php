<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('phone', 'email', 'password', 'name', 'd_o_b', 'last_donation_date', 'pin_code', 'city_id', 'blood_type_id', 'api_token');

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }

    public function posts()
    {
        return $this->morphedByMany('App\Models\Post', 'clientable');
    }

    public function bloodTypesMorph()
    {
        return $this->morphedByMany('App\Models\BloodType', 'clientable');
    }

    public function governoratesMorph()
    {
        return $this->morphedByMany('App\Models\Governorate', 'clientable');
    }

    public function notificationsMorph()
    {
        return $this->morphedByMany('App\Models\Notification', 'clientable')->withPivot("is_read");
    }

    protected $hidden = [
        'password', 'api_token',
    ];

}