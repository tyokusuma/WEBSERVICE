@component('mail::message')
# Dear {{$user->full_name}},

We received a request that you changed your email,

Please verify your new email using the button:

@component('mail::button', ['url' => route('verify', $user->verification_link)
])
Verify your new email
@endcomponent

If you have a question that need to ask, please visit our FAQ or just Contact Us

Best Regards,<br>

Bang Sini Bang Team. 
@endcomponent
