<?php
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function orderapicall_config() {
    $configarray = array(
        "name" => "API Call Order Confirmation ",
        "description" => "This module makes an API call whenever an order is placed.",
        "version" => "1.0",
        "author" => "Prathmesh Rewale",
        "fields" => array(
            "apiurl" => array(
                "FriendlyName" => "API URL",
                "Type" => "text",
                "Size" => "50",
                "Description" => "Enter the API URL to call when an order is placed",
            ),
        )
    );
    return $configarray;
}

function orderapicall_activate() {
    return array('status' => 'success', 'description' => 'Module activated successfully');
}

function orderapicall_deactivate() {
    return array('status' => 'success', 'description' => 'Module deactivated successfully');
}

require_once __DIR__ . '/hooks.php';
?>
