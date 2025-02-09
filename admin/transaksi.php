<?php
include 'config.php'; 

$response = array();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    $response['error'] = true;
    $response['message'] = "Koneksi database gagal: " . $conn->connect_error;
    echo json_encode($response);
    exit();
}


$sql = "SELECT id FROM transactions ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $new_id = $row['id'] + 1;
} else {
    $new_id = 1; 
}


$transaction_id = "MVB" . str_pad($new_id, 6, "0", STR_PAD_LEFT);

$response['error'] = false;
$response['transaction_id'] = $transaction_id;

echo json_encode($response);
$conn->close();
?>
