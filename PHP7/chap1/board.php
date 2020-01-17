<?php

class Board {
  public $subject;
  public $name;
  public $contents;

  public function dispArticle() {
    print $subject = "適当な文字列";
  }
}

$board = new Board;

print $board->dispArticle();