<?php
date_default_timezone_set("Asia/Dhaka");
$asset = $_GET['asset'] ?? '';
$day = $_GET['day'] ?? date("d");
$start = $_GET['start_time'] ?? '00:00';
$end = $_GET['end_time'] ?? '23:59';

$filename = "data/" . date("Y") . "/" . date("m") . "/$day/$asset.json";

if (!file_exists($filename)) {
    echo json_encode(["error" => "File not found"]);
    exit;
}

$data = json_decode(file_get_contents($filename), true);
$result = [];

foreach ($data as $entry) {
    $time = $entry['time'];
    if ($time >= $start && $time <= $end) {
        $result[] = $entry;
    }
}

header('Content-Type: application/json');
echo json_encode($result);
?>