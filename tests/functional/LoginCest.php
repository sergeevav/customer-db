<?php

use app\tests\fixtures\UserFixture;

class LoginCest
{
    public function _before(FunctionalTester $I)
    {
        $I->haveFixtures(
            ['User' =>
                [
                    'class' => UserFixture::className(),
                    'dataFile' => '@app/tests/_data/user.php'
                ]
            ]
        );

        $I->amOnRoute('/');
        $I->seeInCurrentUrl('site/login');
    }

    public function LoginWithEmptyCredentials(FunctionalTester $I)
    {
        $I->submitForm(
            '#login-form',
            [
                'LoginForm[username]' => '',
                'LoginForm[password]' => ''
            ]
        );

        $I->seeValidationError('Username cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');
    }

    public function LoginAsUnregisteredUser(FunctionalTester $I)
    {
        $I->submitForm(
            '#login-form',
            [
                'LoginForm[username]' => 'wrong@user.net',
                'LoginForm[password]' => 'Pa$$w0rd'
            ]
        );

        $I->seeValidationError('Incorrect username or password');
    }

    public function loginWithWrongPassword(FunctionalTester $I)
    {
        $I->submitForm(
            '#login-form',
            [
                'LoginForm[username]' => 'mckenzie.willow@veum.net',
                'LoginForm[password]' => 'wrong_password'
            ]
        );

        $I->seeValidationError('Incorrect username or password.');
    }

    public function loginSuccessfully(FunctionalTester $I)
    {
        $I->submitForm(
            '#login-form',
            [
                'LoginForm[username]' => 'mckenzie.willow@veum.net',
                'LoginForm[password]' => 'pass100500'
            ]
        );

        $I->see('Logout (mckenzie.willow@veum.net)', 'form button[type=submit]');
        $I->dontSeeInTitle('Login');
    }
}
