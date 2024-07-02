<?php
require("../../../init.php");
use WHMCS\Database\Capsule;

// Test database connection
try {
    $result = Capsule::table('tblclients')->count();
    echo "Database connection OK. Total clients: $result<br>";
} catch (Exception $e) {
    echo "Database connection error: " . $e->getMessage() . "<br>";
}

// Manually trigger the OrderAdd hook
try {
    $vars = ['orderid' => 1, 'userid' => 1];
    run_hook('OrderAdd', $vars);
    echo "OrderAdd hook executed.<br>";
} catch (Exception $e) {
    echo "Error executing OrderAdd hook: " . $e->getMessage() . "<br>";
}

// Check if log entries are created
$logs = Capsule::table('tblactivitylog')->orderBy('id', 'desc')->limit(5)->get();
foreach ($logs as $log) {
    echo $log->id . ": " . $log->description . "<br>";
}
?>
