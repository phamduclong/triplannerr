<?php

namespace App\Models\Auth\Traits\Relationship;

use App\Models\Auth\PasswordHistory;
use App\Models\Auth\SocialAccount;
use App\Models\UserDetails;
use App\Models\UserImages;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->hasMany(PasswordHistory::class);
    }


     public function userdetail()
     {
          return $this->hasone('App\Models\UserDetails');
     }

     public function user_images()
     {
        return $this->hasMany(UserImages::class);
     }
}
