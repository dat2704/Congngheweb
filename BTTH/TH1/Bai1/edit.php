<?php
include 'dbo.php';

// Kiểm tra xem có id hoa được gửi đến hay không
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn lấy thông tin của hoa theo id
    $sql = "SELECT * FROM flower WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $flower = $stmt->fetch();

    // Kiểm tra xem hoa có tồn tại không
    if (!$flower) {
        echo "Hoa không tồn tại.";
        exit;
    }

    // Xử lý khi người dùng gửi form (Cập nhật hoa)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];

        // Nếu có ảnh mới, di chuyển ảnh mới vào thư mục images và cập nhật ảnh trong CSDL
        if ($image) {
            // Xóa ảnh cũ nếu có
            $oldImage = $flower['image'];
            if ($oldImage && file_exists('image/' . $oldImage)) {
                unlink('image/' . $oldImage); // Xóa ảnh cũ
            }

            // Di chuyển ảnh mới vào thư mục images
            move_uploaded_file($_FILES['image']['tmp_name'], 'image/' . $image);

            // Cập nhật thông tin hoa vào CSDL
            $sql = "UPDATE flowers SET name = :name, description = :description, image = :image WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':description' => $description,
                ':image' => $image,
                ':id' => $id
            ]);
        } else {
            // Nếu không có ảnh mới, chỉ cập nhật tên và mô tả
            $sql = "UPDATE flower SET name = :name, description = :description WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':description' => $description,
                ':id' => $id
            ]);
        }

        echo "Thông tin hoa đã được cập nhật thành công.";
        header("Location: admin.php"); // Quay lại trang danh sách hoa
        exit;
    }
} else {
    echo "ID hoa không hợp lệ.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Sửa thông tin hoa</h1>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Tên hoa</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($flower['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($flower['description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Chọn ảnh (nếu có)</label>
                <input type="file" class="form-control" id="image" name="image">
                <br>
                <img src="../images/<?= htmlspecialchars($flower['image']) ?>" alt="<?= htmlspecialchars($flower['name']) ?>" width="150">
                <input type="hidden" name="old_image" value="<?= htmlspecialchars($flower['image']) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
        <a href="admin.php" class="btn btn-secondary mt-3">Quay lại danh sách hoa</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
