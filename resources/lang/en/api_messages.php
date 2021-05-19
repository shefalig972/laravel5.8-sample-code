<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Response Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during add update delete etc for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'invalid_credentials' => ['success' => false, 'error_message' => 'These credentials do not match our records.'],
    'inactive_account' => ['success' => false, 'error_message' => 'It\'s seems your account is inactive, please contact us for more details.','swal'=>true,'routerLink' => '/contact-us','title'=> 'Inactive Account','button_text'=>'Contact us'],
    'incomplete_profile' => ['success' => false, 'error_message' => 'You must fill out basic information in your profile in order to proceed with the booking.','swal'=>true,'routerLink' => '/student/basic-information','title'=> 'Incomplete Profile','button_text'=>'Update Basic Information','redirect_after_profile_complete' => 1],
    '404' => ['success' => false, 'error_message' => 'Request cannot be complete data not found.'],
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'failure' => ['success' => false, 'message' => 'Something went wrong please try again.'],
    'success' => ['success' => true, 'message' => ''],
    'no_record' => ['success' => false, 'error_message' => 'No record found.'],
    'invalid' => ['success' => false, 'error_message' => 'Invalid request..'],
    'invalid_open_tok_session' => ['success' => false, 'error_message' => 'Invalid Session id Page Not Found', 'statusCode' => 404],
    'expired_open_tok_session' => ['success' => false, 'error_message' => 'Token has been expired.'],
    'unable_to_generate_opentok_token' => ['success' => false, 'error_message' => 'Unable to create session please try again.'],
    'token_expired_session' => ['success' => false, 'error_message' => 'Session has been completed you can not join the session'],
    'no_token_to_subscribe' => ['success' => false, 'error_message' => 'There are no session to join.'],
    'ban_user_invaild' => ['success' => false, 'error_message' => 'Invalid user email.'],
    'invalid_booking' => ['success' => false, 'error_message' => 'You are not enrolled to join this session.', 'code' => 404],
    'session_has_been_completed' => ['success' => false, 'error_message' => 'Session has been completed, you can not start/join session now.', 'code' => 404],
    'session_is_cancelled' => ['success' => false, 'error_message' => 'Session has been cancelled you can not start session.', 'code' => 404],
    'session_duration_confirmation' => ['success' => true, 'success_message' => '<div class="text-pop-up mb-4"><p>Your session end time is <span class="numtxt"> :end_time </span> ( :hour :minutes from now)</p> <p>Note your session will be recorded. <a id="showMmodalLearnMore" class="link_yellow font-weight-bold" onclick="Window.myComponent.openReadMoreModal()" href="javascript:void(0)">Learn More</a> </p> </div>
        <div class="radio-buttons-container row">
        <div class="label col-4 offset-2">
            <p><b>Turn Off My Video</b></p>
            <label class="switch">
              <input type="checkbox" id="turn-video-off-on" checked="">
              <span class="slider round"></span>
            </label>
        </div>
        <div class="label col-4 ">
             <p><b>Turn Off My Audio</b></p>
            <label class="switch">
              <input type="checkbox" id="turn-audio-off-on" >
              <span class="slider round"></span>
            </label>
        </div></div>', 'swal' => true],


    /**** Api Messages Start From Here ******/
    /**
     * Get Apis messages
     */
    'get' => [
        'success' => ['success' => true, 'success_message' => 'Date retrieve successfully.'],
        'failure' => ['success' => false, 'error_message' => 'Oops! no record found', 'statusCode' => 400],
    ],
    'delete' => [
        'success' => ['success' => true, 'success_message' => 'Record has been removed successfully.'],
        'failure' => ['success' => false, 'error_message' => 'Something went wrong with this record please try again.', 'statusCode' => 400],
    ],
    /****/
    'errors' => [
        'failure' => ['success' => false, 'error_message' => 'Something went wrong please try again.'],
        'invalid_role' => ['success' => false, 'error_message' => 'Invalid role for user please try with valid options']
    ],
    'user' => [
        'login' => [
            'success' => ['success' => true, 'message' => 'User Logged in successfully.', 'data' => []],
            'social_success' => ['success' => true, 'message' => 'Thank you, your account successfully registered with us.', 'data' => []],
            'failure' => ['success' => false, 'message' => 'Something went wrong please try again!', 'statusCode' => 400, 'data' => []],
            'invalid' => ['success' => false, 'message' => 'Please enter valid username and password.', 'data' => []],
            'notauthorized' => ['success' => false, 'message' => 'You are not authorized.', 'data' => []],
            'email_not_registered' => ['success' => false, 'message' => 'Your email is not registered please sign up first.', 'data' => []],
            'verify_email' => ['success' => false, 'message' => 'EmailVerificationRequired', 'data' => []],
            'blocked' => ['success' => false, 'message' => 'Your account is blocked', 'data' => []]
        ],
        'register' => [
            'success' => ['success' => true, 'message' => 'We have sent an email to verify your email account, please check your inbox.', 'data' => []],
            'email_exists' => ['success' => false, 'message' => 'It looks like you already have an account with us. Please sign in', 'data' => [], 'statusCode' => 400],
            'failure' => ['success' => false, 'message' => 'Something went wrong please try again!', 'statusCode' => 400, 'data' => []],
            'check-email' => ['success' => true, 'message' => 'Email sent, please check your email', 'statusCode' => 200, 'data' => []]
        ],
        'profile' => [
            'success' => ['success' => true, 'success_message' => 'Profile has been updated successfully.'],
            'updated' => ['success' => true, 'success_message' => 'Profile is already updated.'],
            'failure' => ['success' => false, 'error_message' => 'Something went wrong please try again!', 'statusCode' => 400],
            'password' => [
                'password_updated' => ['success' => true, 'message' => 'Your password has been updated successfully!.', 'data' => []],
                'notMatched' => ['success' => false, 'message' => 'Current Password does not matched please try again.','data' => [], 'statusCode' => 400],
            ],
            'qualification' => [
                'success' => ['success' => true, 'success_message' => 'Education has been added successfully.'],
            ],
            'work-experience' => [
                'success' => ['success' => true, 'success_message' => 'Work experience has been added successfully.'],
            ],
            'location' => [
                'insert' => ['success' => true, 'success_message' => 'Location has been added successfully.'],
                'update' => ['success' => true, 'success_message' => 'Location has been updated successfully.'],
            ],
            'get' => ['success' => true, 'success_message' => 'Profile retrieve successfully.'],
            'delete' => ['success' => true, 'success_message' => 'Record has been removed successfully.']
        ]
    ],
    'forget_password' => [
        'verify_token' => [
            'success' => ['success' => true, 'message' => 'Token verified successfully.', 'data' => [], 'statusCode' => 200],
            'failure' => ['success' => false, 'message' => 'Invalid token!', 'data' => [], 'statusCode' => 400],
            'expired' => ['success' => false, 'message' => 'Token expired!', 'data' => [], 'statusCode' => 400]
        ],
        'reset-password' => [
            'success' => ['success' => true, 'message' => 'Password updated successfully.', 'data' => [], 'statusCode' => 200],
            'failure' => ['success' => false, 'message' => 'Unable to updated password please try again', 'data' => [], 'statusCode' => 400]
        ],
        'reset-already' => [
            'failure' => ['success' => false, 'message' => 'New password must be different from previous Password.', 'data' => [], 'statusCode' => 400]
        ],
    ],
    'common' => [
        'user' => [
            'invalid' => ['success' => false, 'message' => 'These credentials do not match our records.', 'data' => [], 'statusCode' => 400],
        ],
        'mails' => [
            'not_sent' => ['success' => false, 'message' => 'Unable to send reset password link to your email please try again.', 'data' => [], 'statusCode' => 400],
        ],
        'failure' => ['success' => false, 'message' => 'Something went wrong please try again!!','data' => [], 'statusCode' => 400],
        'retrieve' => ['success' => true, 'message' => 'data retrieve successfully!!', 'data' => []]
    ],
    'auth' => [
        'verify-email' => [
            'resend' => ['success' => true, 'message' => 'Email Verification link has been sent to :email and verify your account.', 'data' => []],
            'success' => ['success' => true, 'message' => 'Email has been verified successfully.', 'data' => []],
            'verified' => ['success' => true, 'message' => 'Email already verified, please login.', 'data' => []],
            'failure' => ['success' => false, 'message' => 'Something went wrong please try again!.', 'data' => [], 'statusCode' => 400],
            'expired' => ['success' => false, 'message' => 'Link has been expired please resend verify email and try again.','data' => [], 'statusCode' => 400],
            'invalid' => ['success' => false, 'message' => 'invalid link please resend verify email and try again.', 'data' => [], 'statusCode' => 400],
            'exception' => ['success' => false, 'message' => 'Invalid email verification token', 'data' => [], 'statusCode' => 400],
            'verified_already' => ['success' => true, 'message' => 'Email already verified, please login.'],
        ],
        'reset-password' => ['success' => true, 'message' => 'Reset Password link has been sent to your email. Please check your email account.', 'data' => []],
        'logout' => [
            'success' => ['success' => true, 'message' => 'Log out successfully.', 'data' => []],
            'failure' => ['success' => false, 'message' => 'Something went wrong please try again!.','data' => []],
        ]
    ],
    'email' => [
        'success' => ['success' => true, 'success_message' => 'Email has been sent successfully we get back to you shortly.'],
        'failure' => ['success' => false, 'error_message' => 'Something went wrong please try again!']
    ],
    'static-page' => [
        'success' => ['success' => true, 'success_message' => 'Data retrieve successfully.'],
        'failure' => ['success' => false, 'error_message' => 'Something went wrong please try again!', 'statusCode' => 400]
    ],
    'faq' => [
        'categories' => ['success' => true, 'success_message' => 'Data retrieve successfully.'],
    ],
    'customer' => [
        'organization' => [
            'cannot-update' => ['success' => false, 'message' => 'Organization already updated once.', 'data' => [],'statusCode' => 400],
        ],
        'contact' => [
            'email-exists' => ['success' => false, 'message' => 'This email is already associated with another contact', 'data' => [],'statusCode' => 400],
            'deleted' => ['success' => true, 'message' => 'Contacts deleted successfully', 'data' => []],
            'cannot-deleted-single' => ['success' => false, 'message' => 'This contact is associated with a Lead or a Booking. Please delete the Lead or Booking before deleting the contact.', 'data' => [], 'statusCode' => 400],
            'cannot-deleted-multiple' => ['success' => false, 'message' => 'One or more selected contact(s) is associated with a Lead or a Booking. Please delete the Lead or Booking before deleting the contact(s).', 'data' => [], 'statusCode' => 400],
            'note' => [
                'created' => ['success' => true, 'message' => 'Note created successfully!', 'data' => []],
                'updated' => ['success' => true, 'message' => 'Note updated successfully!', 'data' => []],
                'deleted' => ['success' => true, 'message' => 'Note deleted successfully!', 'data' => []]
            ],
            'task' => [
                'created' => ['success' => true, 'message' => 'Task created successfully!', 'data' => []],
                'updated' => ['success' => true, 'message' => 'Task updated successfully!', 'data' => []],
                'deleted' => ['success' => true, 'message' => 'Task deleted successfully!', 'data' => []],
                'invalid-due-type' => ['success' => false, 'message' => 'Invalid task due type', 'data' => [], 'statusCode' => 400]
            ],
            'excel' => [
                'invalid-col' => ['success' => false, 'message' => 'unableToImport', 'data' => [], 'statusCode' => 400],
                'value-missing' => ['success' => false, 'message' => 'Required values are missing in the some of the rows in imported file', 'data' => [], 'statusCode' => 400],
                'imported' => ['success' => true, 'message' => 'Contacts imported successfully', 'data' => [], 'statusCode' => 200],
                'invalid-format' => ['success' => false, 'message' => 'Sorry, we could not import your contacts, your file format is not supported', 'data' => [], 'statusCode' => 400]
            ]
        ],
        'service' => [
            'created' => ['success' => true, 'message' => 'Service created successfully!', 'data' => []],
        ],
        'lost-reason' => [
            'created' => ['success' => true, 'message' => 'Lead lost reason created successfully!', 'data' => []],
            'not-found' => ['success' => false, 'message' => 'Lead lost reason id is required!', 'data' => [], 'statusCode' => 400],
        ],
        'source' => [
            'created' => ['success' => true, 'message' => 'Source created successfully!', 'data' => []],
            'invalid-source' => ['success' => false, 'message' => 'Invalid source type', 'data' => [],'statusCode' => 400],
        ],
        'lead' => [
            'invalid-status' => ['success' => false, 'message' => 'Invalid lead status type', 'data' => [], 'statusCode' => 400],
            'deleted' => ['success' => true, 'message' => 'Contacts deleted successfully', 'data' => []],
            'status' => [
                'created' => ['success' => true, 'message' => 'Lead status created successfully!', 'data' => []],
                'updated' => ['success' => true, 'message' => 'Lead status updated successfully!', 'data' => []],
                'deleted' => ['success' => true, 'message' => 'Lead status deleted successfully!', 'data' => []],
                'closed' => ['success' => true, 'message' => 'Lead status updated successfully!', 'data' => []],
                'invalid-position' => ['success' => false, 'message' => 'This lead stage is not allowed to delete', 'data' => [], 'statusCode' => 400],
                'completed-stage-missing' => ['success' => false, 'message' => 'Won/Lost stage is missing', 'data' => [], 'statusCode' => 400],
                'customize-stage-updated' => ['success' => true, 'message' => 'Lead stages updated successfully!', 'data' => []],
                'min-2-stage' => ['success' => false, 'message' => 'Minimum two lead stages are required', 'data' => [], 'statusCode' => 400]
            ],
            'note' => [
                'created' => ['success' => true, 'message' => 'Note created successfully!', 'data' => []],
                'updated' => ['success' => true, 'message' => 'Note updated successfully!', 'data' => []],
                'deleted' => ['success' => true, 'message' => 'Note deleted successfully!', 'data' => []]
            ],
            'task' => [
                'created' => ['success' => true, 'message' => 'Task created successfully!', 'data' => []],
                'updated' => ['success' => true, 'message' => 'Task updated successfully!', 'data' => []],
                'deleted' => ['success' => true, 'message' => 'Task deleted successfully!', 'data' => []],
                'invalid-due-type' => ['success' => false, 'message' => 'Invalid task due type', 'data' => [], 'statusCode' => 400]
            ],
        ],
        'booking' => [
            'invalid-referral' => ['success' => false, 'message' => 'Invalid referral', 'data' => [], 'statusCode' => 400],
            'invalid-service-type' => ['success' => false, 'message' => 'Invalid service type', 'data' => [], 'statusCode' => 400],
            'deleted' => ['success' => true, 'message' => 'Booking deleted successfully.', 'data' => [], 'statusCode' => 200],
            'note' => [
                'created' => ['success' => true, 'message' => 'Note created successfully!', 'data' => []],
                'updated' => ['success' => true, 'message' => 'Note updated successfully!', 'data' => []],
                'deleted' => ['success' => true, 'message' => 'Note deleted successfully!', 'data' => []]
            ],
            'task' => [
                'created' => ['success' => true, 'message' => 'Task created successfully!', 'data' => []],
                'updated' => ['success' => true, 'message' => 'Task updated successfully!', 'data' => []],
                'deleted' => ['success' => true, 'message' => 'Task deleted successfully!', 'data' => []],
                'invalid-due-type' => ['success' => false, 'message' => 'Invalid task due type', 'data' => [], 'statusCode' => 400]
            ],
        ],
        'user' => [
            'task' => [
                'created' => ['success' => true, 'message' => 'Task created successfully!', 'data' => []],
                'updated' => ['success' => true, 'message' => 'Task updated successfully!', 'data' => []],
                'deleted' => ['success' => true, 'message' => 'Task deleted successfully!', 'data' => []],
                'invalid-due-type' => ['success' => false, 'message' => 'Invalid task due type', 'data' => [], 'statusCode' => 400]
            ],
        ],
        'quote' => [
            'deposit-amount' => ['success' => false, 'message' => 'Deposit amount should not be greater then total amount', 'data' => [], 'statusCode' => 400],
            'org-not-setup' => ['success' => false, 'message' => 'Please add organization first.', 'data' => [],'statusCode' => 400],
            'already-sent' => ['success' => false, 'message' => 'Quote already sent to customer, cannot send again.', 'data' => [],'statusCode' => 400],
            'template' => [
               'name-already-exists' => ['success' => false, 'message' => 'Template name already exists', 'data' => [],'statusCode' => 400]
            ],
            'quote-update'=>[
                'not-found' => ['success' => false, 'message' => 'Quote already updated or not found', 'data' => [], 'statusCode' => 400],
                'valid-through-error' => ['success' => false, 'message' => 'Quote date is expired', 'data' => [], 'statusCode' => 400]
            ],
            'no-button-found'=> ['success' => false, 'message' => 'Please add View Quote Detail button in email', 'data' => [], 'statusCode' => 400],
            'no-revision-found' => ['success' => false, 'message' => 'No quote for revision found', 'data' => [], 'statusCode' => 400],
            'start-date' => ['success' => false, 'message' => 'Please add event start date before send to customer', 'data' => [], 'statusCode' => 400],
            'valid-through' => ['success' => false, 'message' => 'Please add valid through before send to customer', 'data' => [], 'statusCode' => 400],
            'quote-not-found' =>['success' => false, 'message' => 'Quote not found', 'data' => [], 'statusCode' => 400],
            'interested-in' => ['success' => false, 'message' => 'Please add interested in to quote before send to customer', 'data' => [], 'statusCode' => 400],

        ],
        'payment'=>[
            'invalid-code' => ['success' => false, 'message' => 'Code is expired please try again', 'data' => [], 'statusCode' => 400],
            'account-not-verified' => ['success' => false, 'message' => 'You must have verified account to receive payment', 'data' => [], 'statusCode' => 400],
            'payment-not-completed' => ['success' => false, 'message' => 'Payment not completed', 'data' => [], 'statusCode' => 400],
            'paypal' => ['success' => false, 'message' => 'Please add your paypal account in profile to receive payments', 'data' => [], 'statusCode' => 400],
        ],
        'invoice' => [
            'not-found' => ['success' => false, 'message' => 'Invoice not found', 'data' => [], 'statusCode' => 400],
            'already-sent' => ['success' => false, 'message' => 'Invoice already sent to customer, cannot send again.', 'data' => [], 'statusCode' => 400],
            'interested-in' => ['success' => false, 'message' => 'Please add interested in to invoice before send to customer', 'data' => [], 'statusCode' => 400],
            'no-button-found' => ['success' => false, 'message' => 'Please add View Invoice Detail button in email', 'data' => [], 'statusCode' => 400],
            'start-date' => ['success' => false, 'message' => 'Please add event date before send to customer', 'data' => [], 'statusCode' => 400],
            'valid-through' => ['success' => false, 'message' => 'Please add valid through before send to customer', 'data' => [], 'statusCode' => 400],

        ],
        'subscription' => [
            'no-plan-found' => ['success' => false, 'message' => 'No Plan found', 'data' => [], 'statusCode' => 400],
            'no-state-found' => ['success' => false, 'message' => 'No State found', 'data' => [], 'statusCode' => 400],
            'already-subscribed' => ['success' => false, 'message' => 'User is already subscribed, please try upgrading your plan', 'data' => [], 'statusCode' => 400],
            'cannot-change' => ['success' => false, 'message' => 'You are not subscribed to any plan. Try buying a new plan.', 'data' => [], 'statusCode' => 400],
            'payment-failed' => ['success' => false, 'message' => 'Cannot update plan, payment failed.', 'data' => [], 'statusCode' => 400],
        ]
    ],

    'coupon' => [
        'invalid-plan' => ['success' => false, 'message' => 'Invalid pricing plan', 'data' => [], 'statusCode' => 400],
        'invalid-code' => ['success' => false, 'message' => 'Invalid coupon code', 'data' => [], 'statusCode' => 400],
        'not-applicable' => ['success' => false, 'message' => 'Coupon code not applicable to this plan', 'data' => [], 'statusCode' => 400],
    ]
    /**************** End Here **************/
];
