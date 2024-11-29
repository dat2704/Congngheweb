<?php
include 'dbo.php';

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Cơ sở dữ liệu '$dbname' đã được tạo hoặc đã tồn tại.<br>";
} else {
    echo "Lỗi khi tạo cơ sở dữ liệu: " . $conn->error . "<br>";
}

$conn->select_db($dbname);

$sql = "CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    option_a VARCHAR(255) NOT NULL,
    option_b VARCHAR(255) NOT NULL,
    option_c VARCHAR(255) NOT NULL,
    option_d VARCHAR(255) NOT NULL,
    answer VARCHAR(255) NOT NULL,  
    question_order INT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'questions' created or already exists.<br>";
} else {
    echo "Lỗi khi tạo bảng: " . $conn->error . "<br>";
}

$filename = "quiz.txt"; 

if (file_exists($filename)) {
    $file = fopen($filename, "r");

    $question = "";
    $option_a = $option_b = $option_c = $option_d = "";
    $answer = "";
    $question_order = 1;

    while (($line = fgets($file)) !== false) {
        if (strpos($line, 'ANSWER:') !== false) {
            $answer = trim(str_replace('ANSWER:', '', $line));
            $answers = explode(",", $answer);

            $sql = "INSERT INTO questions (question, option_a, option_b, option_c, option_d, answer, question_order)
                    VALUES ('$question', '$option_a', '$option_b', '$option_c', '$option_d', '$answer', $question_order)";

            if (!$conn->query($sql)) {
                echo "Lỗi khi thêm câu hỏi: " . $conn->error . "<br>";
            }

            $question = $option_a = $option_b = $option_c = $option_d = "";
            $answer = "";
            $question_order++;  
        } else if (empty($question)) {
            $question = trim($line);
        } else if (empty($option_a)) {
            $option_a = trim($line);
        } else if (empty($option_b)) {
            $option_b = trim($line);
        } else if (empty($option_c)) {
            $option_c = trim($line);
        } else if (empty($option_d)) {
            $option_d = trim($line);
        }
    }

    fclose($file);
    echo "Dữ liệu đã được nhập thành công!";
} else {
    echo "Không tìm thấy file '$filename'.<br>";
}

$conn->close();
?>