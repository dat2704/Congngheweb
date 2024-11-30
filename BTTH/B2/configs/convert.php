<?php
// Đọc nội dung file quiz.txt
$filename = "quiz.txt";
$content = file_get_contents($filename);

// Tách các câu hỏi dựa trên dòng trống
$questions = preg_split('/\n\s*\n/', $content);

// Mảng kết quả JSON
$result = [];

foreach ($questions as $questionBlock) {
    // Tách từng dòng trong khối câu hỏi
    $lines = explode("\n", $questionBlock);

    // Tách câu hỏi và các lựa chọn
    $questionText = $lines[0];
    $choices = [];
    $answer = "";

    foreach ($lines as $line) {
        if (preg_match('/^[A-D]\./', $line)) {
            $choices[] = trim($line);
        } elseif (strpos($line, "ANSWER:") !== false) {
            $answer = trim(str_replace("ANSWER:", "", $line));
        }
    }

    // Thêm vào mảng kết quả
    $result[] = [
        "question" => $questionText,
        "choices" => $choices,
        "answer" => $answer
    ];
}

// Chuyển đổi mảng thành JSON
$json = json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

// Ghi vào file JSON
file_put_contents("quiz.json", $json);

echo "Đã chuyển đổi thành công! File JSON đã được tạo.";
?>
