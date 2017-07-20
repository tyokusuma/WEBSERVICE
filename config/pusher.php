<?php

return [

    'connections' => [

	    'main' => [
	        'auth_key' => env('PUSHER_KEY'),
	        'secret' => env('PUSHER_SECRET'),
	        'app_id' => env('PUSHER_APP_ID'),
	        'options' => [],
	        'host' => null,
	        'port' => null,
	        'timeout' => null,
	    ]
    ]

];
