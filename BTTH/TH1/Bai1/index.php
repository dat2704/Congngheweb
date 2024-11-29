<?php
include 'dbo.php';

$sql = "SELECT * FROM flower";
$stmt = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<div class="container mt-4">
        <h1 class="text-center mb-4" >Danh sách loài hoa</h1>
        <div class="row">
            <?php
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch()) {
                    echo '<div class="col-12 mb-4">'; 
                    echo '<div class="card mb-4">';
                    echo '<img src="image/' . $row['image'] . '" class="card-img-top img-fluid" alt="' . $row['name'] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['name'] . '</h5>';
                    echo '<p class="card-text">' . $row['description'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>Không tìm thấy hoa trong cơ sở dữ liệu</p>";
            }
            ?>
        </div>
    </div>

    <script src="project/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$pdo = null;
?>
