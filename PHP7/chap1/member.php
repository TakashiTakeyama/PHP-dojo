<?php

class Member {
  private $id;
  private $first_name;
  private $last_name;
  private $email;
  private $password;

  function __construct($id, $first_name, $last_name, $email, $password)
  {
    $this->setId($id);
    $this->setFirstName($first_name);
    $this->setLastName($last_name);
    $this->setEmail($email);
    $this->setPassword($password);
  }

  public function setId($id) {
    $this->id = $id;
  }
  
  public function getId() {
    return $this->id;
  }

  public function setFirstName($first_name) {
    $this->first_name = $first_name;
  }

  public function getFirstName() {
    return $this->first_name;
  }

  public function setLastName($last_name) {
    $this->last_name = $last_name;
  }

  public function getLastName() {
    return $this->last_name;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  public function getPassword() {
    return $this->password;
  }
}