<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\SubscriptionPricingPlan;
use App\User;
use App\UserOrgMap;
use App\SubscribedUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
use Illuminate\Support\Facades\DB;
use App\Notifications\VerfifyEmail;
use App\Notifications\WelcomeEmail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterPost;
use App\Http\Traits\Api\Common\UserTrait;
use App\Http\Requests\Api\User\ResendEmailVerification;

class RegisterController extends Controller
{
    use CommonTrait, UserTrait;


    /**
     * @OA\Post  (
     *     path="/v1/register",
     *     summary="Register new User",
     *     description="Register new User",
     *     operationId="/v1/register",
     *     tags={"auth"},
     *     @OA\Parameter(
     *      name="email",
     *      in="query",
     *      description="email id of new user",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="password",
     *      in="query",
     *      description="password for new account",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="password_confirmation",
     *      in="query",
     *      description="confirm password for new account",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="User Registered successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function registerAction(RegisterPost $request)
    {
        try {
            $check_record = User::where('email','=',$request->email)->firstOrFail();
            $response = ['success' => false, 'message' => 'It looks like you already have an account with us. Please sign in', 'data' => [], 'statusCode' => 400];
            return $this->returnResponse($response);
        } catch (\Exception $e) {
        }
        try {
            DB::beginTransaction();
            $values = [
                'user_role_id' => 2,
                'org_id' => 1,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'status' => User::USER_ACTIVE
            ];
            $user = User::create($values);
            $user = User::where('email','=',$request->email)->first();
            $userOrgMap = UserOrgMap::create(['user_id' => $user->id, 'organization_id' => '1', 'created_by' => $user->id, 'updated_by' => $user->id]);
            $this->setDefaultValues($userOrgMap, $user);



            $user->notify(new VerfifyEmail());
            $user->notify(new WelcomeEmail());
            DB::commit();

            # login the user and generate access token
            $token = auth()->claims(['user_org_map_id' => $userOrgMap->id])->attempt(['email' => $request->email,'password' => $request->password]);

            #adding free plan to user
            $subscriptionPlan = SubscriptionPricingPlan::where('id', 1)->get()->first();
            if ($subscriptionPlan->is_active) {
                $planExpirationDate  =  \Carbon\Carbon::now()->addDays($subscriptionPlan->duration_days)->format('Y-m-d');
                $paymentArray = [
                    'user_id' => $user->id,
                    'user_org_map_id' => $userOrgMap->id,
                    'stripe_price_id' => $subscriptionPlan->stripe_price_id,
                    'trial_product_type' => 4,
                    'is_active' => 1,
                    'is_trail' => 1,
                    'plan_start_date' => Carbon::now()->format('Y-m-d'),
                    'plan_expiration_date' => $planExpirationDate,
                    'response' => 'null'
                ];
                SubscribedUser::create($paymentArray);
            }

            $user = User::with('subscribedUser', 'subscribePricingPlan', 'subscribePricingPlan.subscriptionProduct')->where('email', '=', $request->email)->first();

            # capture last login
            User::where('email','=',$request->email)->update(['last_login' => Carbon::now()]);

            $response = [
                'success' => true,
                'error' => false,
                'message' => 'User registered successfully.',
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'entity_count' => $this->getEntityCount(auth()->user()->userOrgMap->id)
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            $response = trans('api_messages.user.register.failure');
        }
        return $this->returnResponse($response);
    }

    public function resendEmailVerification(ResendEmailVerification $request)
    {
        try {
            $user = User::where('email','=',$request->email)->firstOrFail();
            $user->notify(new VerfifyEmail());
            $response = trans('api_messages.user.register.check-email');
        } catch (\Exception $e) {
            $response = trans('api_messages.user.register.failure');
        }
        return $this->returnResponse($response);
    }
}
