<?php
function connectdb() {
    $servername = "localhost"; // Máy chủ
    $username = "root"; // Tên người dùng
    $password = ""; // Mật khẩu
    $dbname = "webivy"; // Tên cơ sở dữ liệu

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Thiết lập chế độ lỗi của PDO thành ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Kết nối thất bại: " . $e->getMessage();
        die();
    }
}
?>
    