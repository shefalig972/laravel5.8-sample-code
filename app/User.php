<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const USER_ACTIVE = 1;
    const USER_INACTIVE = 0;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_role_id','org_id','email','first_name', 'last_name', 'phone', 'license_no', 'password', 'user_timezone','status', 'welcome', 'blocked','last_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    public function userOrgMap()
    {
        return $this->hasOne(UserOrgMap::class, 'user_id');
    }

    public function payment_account()
    {
        return $this->hasOneThrough(PaymentAccount::class, UserOrgMap::class);
    }

    public function test_payment()
    {
        return $this->hasOneThrough(TestPayment::class, UserOrgMap::class)->latest();
    }

    public function subscribedUser(){
        return $this->hasOneThrough(SubscribedUser::class, UserOrgMap::class)->latest();
        #return $this->hasOneThrough(SubscribedUser::class, UserOrgMap::class)->where('is_active' , 1)->latest();
    }

    public function subscribePricingPlan(){

        return $this->hasOneThrough(SubscriptionPricingPlan::class, SubscribedUser::class, 'user_id', 'stripe_price_id','id', 'stripe_price_id')->latest();
        #return $this->hasOneThrough(SubscriptionPricingPlan::class, SubscribedUser::class, 'user_id', 'stripe_price_id','id', 'stripe_price_id')->where('subscribed_users.is_active', 1)->latest();
    }

}
