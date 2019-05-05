<?php

use app\tests\fixtures\UserFixture;

class CustomersCest
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
    }

    public function seeCustomerListAndLogoutLink(FunctionalTester $I)
    {
        // Test user credentials
        $username = 'freida.kovacek@gmail.com';
        $password = 'Pa$$w0rd';

        $I->amGoingTo('log in as a test user');

        $I->amOnRoute('/');
        $I->seeElement('#login-form');

        $I->submitForm(
            '#login-form',
            [
                'LoginForm[username]' => $username,
                'LoginForm[password]' => $password
            ]
        );

        $I->seeInTitle('Customers');

        $I->see('Username', 'a');
        $I->dontSee('Password', 'th');

        $I->see('freida.kovacek@gmail.com', 'td');
        $I->see('nienow.pamela@gmail.com', 'td');
        $I->see('mckenzie.willow@veum.net', 'td');

        $I->see("Logout ({$username})", 'button');
    }
}
