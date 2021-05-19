<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrgMap extends Model
{
    protected $fillable = ['user_id','organization_id','created_by','updated_by'];

    protected $hidden = ['created_at','updated_at'];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
