<?php 

$I = new FunctionalTester($scenario);

$I->wantTo('Check that landing page is up');

$I->amOnRoute('/');
$I->seeInTitle('Sign In');
