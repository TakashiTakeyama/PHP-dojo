<?php

require "member.php";

$member = new Member;
$member->setId("1");
$member->setFirstName("takashi");
$member->setLastName("take");
$member->setEmail("take@gmail.com");
$member->setPassword("uketuke");

echo $member->getId(). "\n";
echo $member->getFirstName() . "\n";
echo $member->getLastName() . "\n";
echo $member->getEmail() . "\n";
echo $member->getPassword();