<?php
include 'dbo.php';

$sql = "SELECT * FROM questions ORDER BY question_order"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài thi trắc nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h1 class="text-center mb-4">Bài thi trắc nghiệm</h1>
    <form method="POST" action="submit.php">
        <?php
        if ($result->num_rows > 0) {
            $i = 1;
            while($row = $result->fetch_assoc()) {
                echo "<div class='question'>
                        <h3>Câu $i: " . $row['question'] . "</h3>
                        <div class='form-check'>
                            <input type='checkbox' class='form-check-input' name='question_" . $row['id'] . "[]' value='A'>
                            <label class='form-check-label'>" . $row['option_a'] . "</label>
                        </div>
                        <div class='form-check'>
                            <input type='checkbox' class='form-check-input' name='question_" . $row['id'] . "[]' value='B'>
                            <label class='form-check-label'>" . $row['option_b'] . "</label>
                        </div>
                        <div class='form-check'>
                            <input type='checkbox' class='form-check-input' name='question_" . $row['id'] . "[]' value='C'>
                            <label class='form-check-label'>" . $row['option_c'] . "</label>
                        </div>
                        <div class='form-check'>
                            <input type='checkbox' class='form-check-input' name='question_" . $row['id'] . "[]' value='D'>
                            <label class='form-check-label'>" . $row['option_d'] . "</label>
                        </div>
                        </div>";
                $i++;
            }
        } else {
            echo "<p class='text-center'>Không có câu hỏi nào trong cơ sở dữ liệu.</p>";
        }
        ?>
        <button type="submit" class="btn btn-success">Nộp bài</button>
    </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>