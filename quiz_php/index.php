<?php

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/Quiz.php');

$quiz = new Quiz();

if (!$quiz->isFinished()) {
  $data = $quiz->getCurrentQuiz();
  shuffle($data['a']);
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>Quiz</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <?php if ($quiz->isFinished()) : ?>
    <div id="container">
      <div id="result">
        Your score
        <div><?= h($quiz->getScore()); ?></div>
      </div>
      <a href=""><div id="btn">Replay?</div></a>
    </div>
    <a href="">finished!</a>
    <?php $quiz->reset(); ?>
    <?php else : ?>
    <div id="container">
      <h1>Q. <?= h($data['q']); ?></h1>
        <ul>
          <?php foreach ($data['a'] as $a) : ?>
            <li class="answer"><?= h($a); ?></li>
          <?php endforeach; ?>
        </ul>
        <div id="btn" class="disabled"><?= $quiz->isLast() ? 'Show Result' : 'Next Question' ; ?></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/quiz.js"></script>
    <?php endif; ?>
  </body>
</html>
