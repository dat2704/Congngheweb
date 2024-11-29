<?php
include 'dbo.php';

// Đọc danh sách hoa từ CSDL
$sql = "SELECT * FROM flower";
$stmt = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý danh sách hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Quản lý danh sách hoa</h1>
        <a href="add.php" class="btn btn-success mb-3">Thêm hoa mới</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên hoa</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $stmt->fetch()) {
                        echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td><img src='image/" . $row['image'] . "' width='100'></td>";
                            echo "<td><a href='edit.php?id=" . $row['id']. "' class='text-primary'>✏️</i></a></td>";
                            echo "<td><a href='delete.php?id=" . $row['id'] . "' class='text-danger'>🗑️</i></a></td>";            
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>