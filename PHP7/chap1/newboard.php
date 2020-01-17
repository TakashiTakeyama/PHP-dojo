<?php

require_once "board.php";

class NewBoard extends Board {

  public function dispArticle()
  {
    print $subject = "適切な文字列。";
  }

  public function createArticle() {

  }

  public function sendArtcle() {

  }

  public function editArtcle() {

  }

  public function destroyArticle() {

  }
}

$newboard = new NewBoard();
echo $newboard->dispArticle();
