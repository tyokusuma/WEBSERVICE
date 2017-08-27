@component('mail::message')
# Dear {{$user->full_name}},

We received a request that you forgot your password,

Please using these link to change your old password into a new one:

@component('mail::button', ['url' => route('verify-web', ['reset' => $user->reset_password])
])
Change your password
@endcomponent

If you have a question that need to ask, please visit our FAQ or just Contact Us

Best Regards,<br>

Bang Sini Bang Team. 
@endcomponent
