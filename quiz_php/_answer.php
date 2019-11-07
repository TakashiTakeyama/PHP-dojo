<?php

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/Quiz.php');

$quiz = new MyApp\Quiz();
$correctAnswer = $quiz->checkAnswer();

header('Content-Type: application/json; charset=UTF-8');
//json形式で送る
echo json_encode([
  'correct_answer' => $correctAnswer
]);