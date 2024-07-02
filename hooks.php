<?php
use WHMCS\Database\Capsule;

logActivity('hooks.php file loaded');

add_hook('ShoppingCartCheckoutCompletePage', 1, function($vars) {
    logActivity('OrderAdd Hook Triggered');
    try {
        logActivity('Order ID: ' . $vars['orderid']);
        
        $apiurl = Capsule::table('tbladdonmodules')->where('module', 'orderapicall')->where('setting', 'apiurl')->value('value');
        logActivity('API URL: ' . $apiurl);
        
        $orderId = $vars['orderid'];
        $postData = [
            'orderId' => $orderId,
            'ordernumber' => $vars['ordernumber'],
            'invoiceid' => $vars['invoiceid'],
            'ispaid' => $vars['ispaid'],
            'amount' => $vars['amount'],
            'paymentmethod' => $vars['paymentmethod'],
            'clientId' => $vars['clientdetails'],
        ];
        // Convert data to JSON format
    $jsonData = json_encode($postData);

        logActivity('Post Data: ' . json_encode($postData));

        $ch = curl_init($apiurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        // Set the content type header
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
    ]);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        $verbose = fopen('php://temp', 'w+');
        curl_setopt($ch, CURLOPT_STDERR, $verbose);

        $response = curl_exec($ch);
        $curlError = curl_error($ch);
        rewind($verbose);
        $verboseLog = stream_get_contents($verbose);
        curl_close($ch);

        logModuleCall('orderapicall', 'OrderAdd', $postData, $response, $curlError, $verboseLog);
    } catch (Exception $e) {
        logActivity('Exception in OrderAdd Hook: ' . $e->getMessage());
    }
});
?>
