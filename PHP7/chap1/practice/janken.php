<?php

function pon() {
  $pon = trim(fgets(STDIN));
  janken_pon($pon);
}

function janken_pon($pon) {
  if ($pon === "a") {
    echo "あなたの勝ちです。";
    return;
  } elseif($pon === "b") {
    echo "あなたの負けです。";
    return;
  } else {
    echo "あいこです、もう一度。" . "\n";
  }
  pon();
  // return;
}

pon();