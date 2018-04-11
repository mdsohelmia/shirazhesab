<?php

return [

    //-------------------------------
    // Timezone for insert dates in database
    // If you want Gateway not set timezone, just leave it empty
    //--------------------------------
    'timezone' => 'Asia/Tehran',
    'soap' => array(
        'attempts' => 2 // Attempts if soap connection is fail
    ),
    //--------------------------------
    // Receipt gateway
    //--------------------------------
    'receipt' => [
        'enable' => 'no',
        'account_id' => '1',
        'title' => 'فیش بانکی',
    ],
    //--------------------------------
    // Zarinpal gateway
    //--------------------------------
    'zarinpal' => [
        'enable' => 'no',
        'account_id' => '1',
        'title' => 'زرین پال',
        'merchant-id'  => '',
        'type'         => 'zarin-gate',             // Types: [zarin-gate || normal]
        'callback-url' => '/callback',
        'server'       => 'germany',                // Servers: [germany || iran || test]
        'email'        => 'email@gmail.com',
        'mobile'       => '09xxxxxxxxx',
        'description'  => 'description',
    ],

    //--------------------------------
    // Mellat gateway
    //--------------------------------
    'mellat' => [
        'enable' => 'no',
        'account_id' => '1',
        'title' => 'به پرداخت ملت',
        'username'     => '',
        'password'     => '',
        'terminalId'   => '',
        'callback-url' => '/callback'
    ],

    //--------------------------------
    // Saman gateway
    //--------------------------------
    'saman' => [
        'enable' => 'no',
        'account_id' => '1',
        'title' => 'سامان کیش',
        'merchant'     => '',
        'password'     => '',
        'callback-url'   => '/callback',
    ],

    //--------------------------------
    // PayIr gateway
    //--------------------------------
    'payir'    => [
        'enable' => 'no',
        'account_id' => '1',
        'title' => 'Pay.ir',
        'api'          => 'xxxxxxxxxxxxxxxxxxxx',
        'callback-url' => '/callback'
    ],

    //--------------------------------
    // Sadad gateway
    //--------------------------------
    'sadad' => [
        'enable' => 'no',
        'account_id' => '1',
        'title' => 'سداد ملی',
        'merchant'      => '',
        'transactionKey'=> '',
        'terminalId'    => '0',
        'callback-url'  => '/callback'
    ],
    
    //--------------------------------
    // Parsian gateway
    //--------------------------------
    'parsian' => [
        'enable' => 'no',
        'account_id' => '1',
        'title' => 'پارسیان',
        'pin'          => 'xxxxxxxxxxxxxxxxxxxx',
        'callback-url' => '/callback'
    ],
    //--------------------------------
    // Pasargad gateway
    //--------------------------------
    'pasargad' => [
        'enable' => 'no',
        'account_id' => '1',
        'title' => 'پاسارگاد',
        'terminalId'    => '',
        'merchantId'    => '',
        'certificate-path'    => '',
        'callback-url' => '/callback'
    ],

    //--------------------------------
    // Asan Pardakht gateway
    //--------------------------------
    'asanpardakht' => [
        'enable' => 'no',
        'account_id' => '1',
        'title' => 'آسان پرداخت',
        'merchantId'     => '',
        'merchantConfigId'     => '',
        'username' => '',
        'password' => '',
        'key' => '',
        'iv' => '',
        'callback-url'   => '/callback',
    ],

    //--------------------------------
    // Paypal gateway
    //--------------------------------
    'paypal'   => [
        'enable' => 'no',
        'account_id' => '1',
        'title' => 'PayPal',
        // Default product name that appear on paypal payment items
        'default_product_name' => 'My Product',
        'default_shipment_price' => 0,
        // set your paypal credential
        'client_id' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        'secret'    => 'xxxxxxxxxx_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        'settings'  => [
            'mode'                   => 'sandbox', //'sandbox' or 'live'
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled'         => true,
            'log.FileName'           => storage_path() . '/logs/paypal.log',
            /**
             * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
             *
             * Logging is most verbose in the 'FINE' level and decreases as you
             * proceed towards ERROR
             */
            'call_back_url'          => '/callback',
            'log.LogLevel'           => 'FINE'

        ]
    ],
    //--------------------------------
    // IranKish gateway
    //--------------------------------
    'irankish' => array(
        'enable' => 'yes',
        'account_id' => '2',
        'title' => 'ایران کیش',
        'merchant-id' => '',
        'sha1-key' => '',
        'description' => 'description',
        'callback-url' => '/callback'
    ),
    //--------------------------------
    // Saderat gateway
    //--------------------------------
    'saderat' => array(
        'enable' => 'no',
        'account_id' => '1',
        'title' => 'مبنا کارت صادرات',
        'merchant-id' => '',
        'terminal-id' => '',
        'public-key' => '',
        'private-key' => '',
        'callback-url' => '/callback'
    ),
    //-------------------------------
    // Tables names
    //--------------------------------
    'table'    => 'gateway_transactions',

];
