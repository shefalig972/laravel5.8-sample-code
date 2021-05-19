<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Contact extends Model
{
    use AuditableTrait;

    protected $fillable = [
        'user_org_map_id',
        'first_name',
        'last_name',
        'email',
        'phone_type',
        'phone',
        'organization',
        'title',
        'referred_by',
        'first_name_information',
        'is_imported',
        'imported_on'
    ];

    protected $hidden = ['user_org_map_id','created_by','updated_by'];

    public function referredBy()
    {
        return $this->belongsTo('App\Contact', 'referred_by', 'id');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'contact_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'contact_id');
    }

    public function quotes()
    {
        return $this->hasMany(Booking::class, 'contact_id');
    }

    public function invoices(){
        return $this->hasMany(Invoice::class, 'contact_id');
    }

}