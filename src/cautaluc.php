<?php
    //require __DIR__ . '/vendor/autoload.php';
    use Twilio\Rest\Client;
    
    // Your Account SID and Auth Token from twilio.com/console
    $account_sid = 'AC23710edd9d6f65043003069e54142c6b';
    $auth_token = '69666f1cab712ce6ce42b2d09eba696d';
    // In production, these should be environment variables. E.g.:
    // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]
    
    // A Twilio number you own with SMS capabilities
    $twilio_number = "+16097939142";
    
    $client = new Client($account_sid, $auth_token);
    $client->messages->create(
        // Where to send a text message (your cell phone?)
        '+40760330010',
        array(
            'from' => $twilio_number,
            'body' => 'huhuh'
        )
    );
?>
