@component('mail::message')
# Dear {{$user->full_name}},

We received a request that you already created an account,

Please verify your account using this button:

@component('mail::button', ['url' => route('verify', $user->verification_link)
])
Verify your account
@endcomponent

If you have a question that need to ask, please visit our FAQ or just Contact Us

Best Regards,<br>

Bang Sini Bang Team. 
@endcomponent
