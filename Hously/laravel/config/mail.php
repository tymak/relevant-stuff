<?php

return [


        'driver' => env('MAIL_DRIVER', 'smtp'),


        'host' => env('MAIL_HOST', 'smtp.mailgun.org'),


        'port' => env('MAIL_PORT', 587),


        'from' => ['address' => 'rehord@email.cz', 'name' => 'Email Reset'],


        'encryption' => 'tls',


        'username' => env('MAIL_USERNAME'),



        'password' => env('MAIL_PASSWORD'),


        'sendmail' => '/usr/sbin/sendmail -bs',


        'pretend' => false,
'markdown' => [
    'theme' => 'default',

    'paths' => [
        resource_path('views/vendor/mail'),
    ],
],

];