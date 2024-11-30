<?php
    require_once "../model/database.php";
    $correctAnswers = 0;

// Lặp qua từng câu hỏi trong dữ liệu
    foreach ($data as $index => $item) {
    // Lấy câu trả lời người dùng chọn từ $_GET
    $userAnswer = isset($_GET["question_" . $index]) ? $_GET["question_" . $index] : null;

    // Xử lý và lấy ký tự đáp án (phần trước dấu chấm)
    $userAnswerLetter = $userAnswer ? substr($userAnswer, 0, 1) : null;

    // So sánh với đáp án đúng
    if ($userAnswerLetter === $item['answer']) {
        $correctAnswers++;
    }
}

// Hiển thị kết quả
echo "Số câu trả lời đúng: " . $correctAnswers . "/" . count($data);

?>