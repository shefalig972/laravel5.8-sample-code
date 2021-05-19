<?php

namespace App\Http\Traits\Api\User\Auth;

use App\Http\Traits\Api\Common\UserTrait;
use App\Notifications\PasswordResetEmail;
use App\User;
use Illuminate\Support\Facades\Mail;

trait ResetPassword
{
    use UserTrait;
    public function resetPassword($post)
    {

        $user = User::whereEmail($post->input('email'))->first();
        if ($user == null) {
            $response = trans('api_messages.common.user.invalid');
            return $response;
        }

        $user->token = $this->saveToken($user);
        $username  = $user->first_name.' '. $user->last_name;
            
        $user->notify(new PasswordResetEmail($user->token,$username));
        if (Mail::failures()) {
            // return response showing failed emails
            $response = trans('api_messages.common.mails.not_sent');
            return $response;
        }

        $response = trans('api_messages.auth.reset-password');

        return $response;
    }
}
