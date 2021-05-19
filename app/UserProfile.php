<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class UserProfile extends Model
{
    use AuditableTrait;

    protected $fillable = ['user_id','phone','business_owner','created_by','updated_by'];

    protected $hidden = ['created_by','updated_by'];
}
