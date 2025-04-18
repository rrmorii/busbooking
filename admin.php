<?php
require __DIR__ . '/vendor/autoload.php';

$conn = new MongoDB\Client("mongodb://localhost:27017");

$db = $conn->busbooking;
$collection = $db->admin;

// Get POST data from the form
$busName = $_POST['busName'];
$driverName = $_POST['driverName'];
$busNumber = $_POST['busNumber'];
$driverContact = $_POST['driverContact'];
$plateNumber = $_POST['plateNumber'];
$conductorName = $_POST['conductorName'];
$route = $_POST['route'];
$conductorContact = $_POST['conductorContact'];
$travelTime = $_POST['travelTime'];

// Optional: handle image upload (basic example)
$imageName = $_FILES['busImage']['name'];
$imageTmp = $_FILES['busImage']['tmp_name'];
$imagePath = 'uploads/' . basename($imageName);
move_uploaded_file($imageTmp, $imagePath);

// Insert data into MongoDB
$insertResult = $collection->insertOne([[
    'busName' => $busName,
    'driverName' => $driverName,
    'busNumber' => $busNumber,
    'driverContact' => $driverContact,
    'plateNumber' => $plateNumber,
    'conductorName' => $conductorName,
    'route' => $route,
    'conductorContact' => $conductorContact,
    'travelTime' => $travelTime,
    'busImage' => $imagePath 
]]);
header('Location: http://localhost/BusBooking/manage.html');
exit;
?>