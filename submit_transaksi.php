<?php
include 'config.php'; 

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction_id = $_POST['transaction_id'];
    $user_id = $_POST['user_id'];
    $subscription_level = $_POST['subscription_level'];

    if (empty($transaction_id) || empty($user_id) || empty($subscription_level)) {
        $response['error'] = true;
        $response['message'] = "Semua field harus diisi!";
        echo json_encode($response);
        exit();
    }

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        $response['error'] = true;
        $response['message'] = "Koneksi database gagal: " . $conn->connect_error;
        echo json_encode($response);
        exit();
    }

    $sql_check = "SELECT created_at FROM transactions WHERE user_id = ? ORDER BY created_at DESC LIMIT 1";
    $stmt = $conn->prepare($sql_check);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_transaction_date = strtotime($row['created_at']);
        $thirty_days_ago = strtotime("-30 days");

        if ($last_transaction_date > $thirty_days_ago) {
            $response['error'] = true;
            $response['message'] = "Langganan anda masih ada.";
            echo json_encode($response);
            exit();
        }
    }

    $sql_insert = "INSERT INTO transactions (id, user_id, subscription_level) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("sss", $transaction_id, $user_id, $subscription_level);

    if ($stmt->execute()) {
        $response['error'] = false;
        $response['message'] = "Transaksi berhasil disimpan!";
    } else {
        $response['error'] = true;
        $response['message'] = "Gagal menyimpan transaksi: " . $conn->error;
    }

    echo json_encode($response);
    $conn->close();
} else {
    $response['error'] = true;
    $response['message'] = "Metode tidak diizinkan!";
    echo json_encode($response);
}
?>
