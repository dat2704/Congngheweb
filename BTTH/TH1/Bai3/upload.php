<?php
// Kết nối tới CSDL
$servername = "localhost";
$username = "root"; // Thay bằng username MySQL của bạn
$password = ""; // Thay bằng password MySQL của bạn
$dbname = "data_csv";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_POST['upload'])) {
    // Kiểm tra file được upload
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['csv_file']['tmp_name'];
        $fileName = $_FILES['csv_file']['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Kiểm tra định dạng file CSV
        if (strtolower($fileExtension) === 'csv') {
            // Đọc nội dung file
            if (($handle = fopen($fileTmpPath, "r")) !== FALSE) {
                // Bỏ qua dòng đầu tiên (header)
                fgetcsv($handle, 1000, ",");

                // Lặp qua các dòng còn lại và lưu vào CSDL
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $username = $conn->real_escape_string($data[0]);
                    $password = $conn->real_escape_string($data[1]);
                    $lastname = $conn->real_escape_string($data[2]);
                    $firstname = $conn->real_escape_string($data[3]);
                    $city = $conn->real_escape_string($data[4]);
                    $email = $conn->real_escape_string($data[5]);
                    $course1 = $conn->real_escape_string($data[6]);

                    $checkQuery = "SELECT * FROM 64KTPM3 WHERE username = '$username'";
                    $checkResult = $conn->query($checkQuery);

                    $sql = "INSERT INTO 64ktpm3 (username, password, lastname, firstname, city, email, course1) 
                            VALUES ('$username', '$password', '$lastname', '$firstname', '$city', '$email', '$course1')";
                    
                    if ($checkResult->num_rows === 0) {
                        // Nếu không trùng, thêm mới
                        $sql = "INSERT INTO 64KTPM3 (username, password, lastname, firstname, city, email, course1) 
                                VALUES ('$username', '$password', '$lastname', '$firstname', '$city', '$email', '$course1')";
                        $conn->query($sql);
                    }
                }
                fclose($handle);
                $message = "<div class='alert alert-success text-center' role='alert'>File CSV đã được xử lý thành công!<br></div>";
            } else {
                $message = "<div class='alert alert-danger'>Không thể đọc file CSV.</div>";
            }
        } else {
            $message = "<div class='alert alert-danger'>Vui lòng upload một file CSV hợp lệ.</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Lỗi khi upload file. Vui lòng thử lại.</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload file csv</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Tải lên dữ liệu file CSV</h2>
                        <p class="text-center text-muted">Vui lòng upload file CSV để lưu vào cơ sở dữ liệu</p>
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="file" class="form-label">Chọn file CSV:</label>
                                <input type="file" class="form-control" name="csv_file" id="file" accept=".csv" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="upload" class="btn btn-success">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>