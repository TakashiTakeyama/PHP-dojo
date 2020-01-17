<?php

class Members implements IteratorAggregate {
  private $member = [];

  //引数にタイプヒンティング: パラメータの型を指定できる。
  public function add(Member $member) {
    $this->members = $member;
  }

  public function getIterator()
  {
    return new ArrayIterator($this->members);
  }
}