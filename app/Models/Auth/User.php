<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Attribute\UserAttribute;
use App\Models\Auth\Traits\Method\UserMethod;
use App\Models\Auth\Traits\Relationship\UserRelationship;
use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Auth\Role;

/**
 * Class User.
 */
class User extends BaseUser
{
    use UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope;

        protected $table = 'users';

		protected $fillable = [
		   'uuid',
		   'first_name',
		   'last_name',
		   'user_name',
		   'role_type',
		   'email',
		   'avatar_type',
		   'avatar_location',
		   'password',
		   'password_changed_at',
		   'confirmation_code',
		   'confirmed',
		   'approval_status',
		   'subscription_id',
		   'travel_agency',
		   'active',
		   'timezone',
		   'last_login_at',
		   'last_login_ip',
		   'to_be_logged_out',
		   'remember_token',
		   'created_at',
		   'updated_at',
		   'deleted_at',
		   'security_user',
		   'request_active_invitation',
		   'voucher_five_dollar',
		   'voucher_twenty_five_dollar',
		   'voucher_fifty_dollar',
		   'voucher_one_month',
		   'voucher_three_month',
		   'voucher_one_year',
		   'accept_invitation_date',
		   'request_invitation_date',
		   'invitation_interval',
		   'trial_date',
		  ];
 	public function role_name(){
        return $this->belongsTo(Role::class, 'role_type'); 
    }

	public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
