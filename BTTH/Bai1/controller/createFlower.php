<?php
    require '../configs/database.php';

    // Kiểm tra kết nối
    if (!$connection) {
        die("Kết nối cơ sở dữ liệu thất bại");
    }

    // Lấy dữ liệu từ form
    $name = $_POST['name'] ?? '';
    $desc = $_POST['description'] ?? '';
    $image = $_POST['image'] ?? '';

    // Kiểm tra dữ liệu nhập
    if (empty($name) || empty($desc) || empty($image)) {
        die("Vui lòng điền đầy đủ thông tin");
    }

    // Thực hiện truy vấn
    $sql = "INSERT INTO flowers(name, description, image) VALUES (:name, :description, :image)";
    try {
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $desc);
        $stmt->bindParam(':image', $image);
        $stmt->execute();
        // echo "Thêm thành công";
    } catch (PDOException $e) {
        // echo "Lỗi: " . 
        $e->getMessage();
    }
    header("Location: ../src/admin.php");
?>
