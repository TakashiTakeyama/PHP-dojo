<?php

class AccountController extends Controller
{
  public function signupAction()
  {
    return $this->render(array(
      '_token' => $this->generateCsrftoken('account/signup'),
    ));
  }
}