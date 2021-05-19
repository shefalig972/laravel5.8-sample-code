<?php

namespace App\Http\Controllers\Api;

use App\Http\Traits\Api\User\Auth\ResetPassword;
use App\Http\Traits\CommonTrait;
use App\SubscribedUser;
use App\SubscriptionPricingPlan;
use App\User;
use App\UserOrgMap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use CommonTrait, ResetPassword;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','sendResetLinkEmail','resetPostRequest']]);
    }

    /**
     * @OA\Post(
     * path="/v1/login",
     * summary="Sign in",
     * description="Login by email, password",
     * operationId="authLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     */
    public function login(Request $request)
    {
        try {
            $credentials = request(['email', 'password']);

            try {
                $user = User::where('email','=',$request->email)->with('subscribedUser', 'subscribePricingPlan', 'subscribePricingPlan.subscriptionProduct')->firstOrFail();
            } catch (\Exception $e) {
                $response = trans('api_messages.user.login.invalid');
                return $this->returnResponse($response, 400);
            }

            if ($user->blocked == 1) {
                $response = trans('api_messages.user.login.blocked');
                return $this->returnResponse($response, 400);
            }

            if (!Hash::check($request->password, $user->password)) {
                $response = trans('api_messages.user.login.invalid');
                return $this->returnResponse($response, 400);
            }

            try {
                $userOrgMap = UserOrgMap::where(['user_id' => $user->id, 'organization_id' => $user->org_id])->firstOrFail();
            } catch (\Exception $e) {
                $response = trans('api_messages.user.login.invalid');
                return $this->returnResponse($response, 400);
            }

            if (! $token = auth()->claims(['user_org_map_id' => $userOrgMap->id])->attempt($credentials)) {
                $response = trans('api_messages.user.login.invalid');
                return $this->returnResponse($response, 400);
            }

            if ($user->user_role_id != 2) {
                $response = trans('api_messages.user.login.invalid');
                return $this->returnResponse($response, 400);
            }
            if (!$user->email_verified_at && $user->created_at->diffInDays(Carbon::now()) > 1) {
                $response = trans('api_messages.user.login.verify_email');
                return $this->returnResponse($response, 400);
            }

            # if user is not subscribed to any plan then subscribe the user to FREE Trial
            try {
                $subscribedUser = SubscribedUser::where('user_id','=', $user->id)->firstOrFail();
            } catch (\Exception $e) {
                #adding free plan to user
                $subscriptionPlan = SubscriptionPricingPlan::where('id', 1)->get()->first();
                if ($subscriptionPlan->is_active) {
                    $planExpirationDate  =  \Carbon\Carbon::now()->addDays($subscriptionPlan->duration_days)->format('Y-m-d');
                    $paymentArray = [
                        'user_id' => $user->id,
                        'user_org_map_id' => $userOrgMap->id,
                        'stripe_price_id' => $subscriptionPlan->stripe_price_id,
                        'trial_product_type' => 3,
                        'is_active' => 1,
                        'is_trail' => 1,
                        'plan_start_date' => Carbon::now()->format('Y-m-d'),
                        'plan_expiration_date' => $planExpirationDate,
                        'response' => 'null'
                    ];
                    SubscribedUser::create($paymentArray);
                }
            }

            # capture last login
            User::where('email','=',$request->email)->update(['last_login' => Carbon::now()]);

            $response = [
                'success' => true,
                'error' => false,
                'message' => 'User Logged in successfully.',
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'entity_count' => $this->getEntityCount(auth()->user()->userOrgMap->id)
            ];
        } catch (\Exception $e) {
            return $this->throwException($e);
        }

        return $this->returnResponse($response, 200);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = User::where('id','=',auth()->user()->id)->with('profile','organization', 'payment_account', 'test_payment', 'subscribedUser','subscribedUser.stateTax', 'subscribePricingPlan', 'subscribePricingPlan.subscriptionProduct')->first();
        return $this->returnData($user, 'success');
    }

    /**
     * @OA\Get (
     *     path="/v1/logout",
     *     summary="Logout Route",
     *     description="Logout Route",
     *     operationId="/v1/logout",
     *     tags={"auth"},
     *     @OA\Parameter(
     *      name="Authorization",
     *      in="header",
     *      description="Pass bearer access token in Authorization",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="User Logout Successfuly.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            auth()->logout();
            $response = trans('api_messages.auth.logout.success');
        } catch (\Exception $e) {
            return $this->throwException($e);
        }

        return $this->returnResponse($response);
    }

    /**
     * @OA\Post  (
     *     path="/v1/refresh",
     *     summary="Refresh Access Token",
     *     description="Refresh Access Token",
     *     operationId="/v1/refresh",
     *     tags={"auth"},
     *     @OA\Parameter(
     *      name="Authorization",
     *      in="header",
     *      description="Pass bearer access token in Authorization",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="Access token generated Successfuly.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'error' => false,
            'success' => true,
            'message' => 'success',
            'data' => [],
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'statusCode' => 200
        ]);
    }


    /**
     * @OA\Post  (
     *     path="/v1/password/email",
     *     summary="Request password reset link",
     *     description="Request password reset link",
     *     operationId="/v1/password/email",
     *     tags={"auth"},
     *     @OA\Parameter(
     *      name="email",
     *      in="query",
     *      description="user email",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="Reset password email sent successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */

    /**
     * Send Reset password link to email
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        try {
            $post = $request;
            $response = $this->resetPassword($post);
            return $this->returnResponse($response);
        } catch (\Exception $exception) {
            return $this->throwException($exception);
        }
    }

    /**
     * @OA\Post  (
     *     path="/v1/reset-password",
     *     summary="Request password using reset link",
     *     description="Request password using reset link",
     *     operationId="/v1/reset-password/",
     *     tags={"auth"},
     *     @OA\Parameter(
     *      name="token",
     *      in="query",
     *      description="reset password token",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="password",
     *      in="query",
     *      description="new password",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="Reset password email sent successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function resetPostRequest(Request $request)
    {
        try {
            $response = $this->checkToken($request->token, $request);
            return $this->returnResponse($response);
        } catch (\ErrorException $errorException) {
            return $this->throwException($errorException);
        }

    }
}
