<?php

use app\tests\fixtures\UserFixture;

class SignupCest
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

        $I->amOnRoute('site/login');
        $I->click('Sign up');

        $I->seeInCurrentUrl('site/signup');
        $I->seeInTitle('Sign Up');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->submitForm(
            '#signup-form',
            [
                'SignupForm[username]' => '',
                'SignupForm[password]' => '',
                'SignupForm[confirmPassword]' => '',
            ]
        );

        $I->seeValidationError('Username cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');
        $I->seeValidationError('Confirm Password cannot be blank.');
    }

    public function signupWithInvalidUsername(FunctionalTester $I)
    {
        $I->submitForm(
            '#signup-form',
            [
                'SignupForm[username]' => 'invalid_email',
                'SignupForm[password]' => 'Pa$$w0rd',
                'SignupForm[confirmPassword]' => 'Pa$$w0rd',
            ]
        );

        $I->seeValidationError('Username is not a valid email address.');
    }

    public function signupWithAlreadyTakenUsername(FunctionalTester $I)
    {
        $I->submitForm(
            '#signup-form',
            [
                'SignupForm[username]' => 'nienow.pamela@gmail.com',
                'SignupForm[password]' => 'Pa$$w0rd',
                'SignupForm[confirmPassword]' => 'Pa$$w0rd',
            ]
        );

        $I->seeValidationError('This username has already been taken.');
    }

    public function signupWithWrongConfirmPassword(FunctionalTester $I)
    {
        $I->submitForm(
            '#signup-form',
            [
                'SignupForm[username]' => 'feest.ramon@hilpert.info',
                'SignupForm[password]' => 'Password_0',
                'SignupForm[confirmPassword]' => 'Password_1',
            ]
        );

        $I->seeValidationError('Confirm Password must be equal to "Password".');
    }

    public function signupWithInsecurePassword(FunctionalTester $I)
    {
        $I->submitForm(
            '#signup-form',
            [
                'SignupForm[username]' => 'feest.ramon@hilpert.info',
                'SignupForm[password]' => 'Pass',
                'SignupForm[confirmPassword]' => 'Pass',
            ]
        );

        $I->seeValidationError('Password should contain at least 8 characters.');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm(
            '#signup-form',
            [
                'SignupForm[username]' => 'feest.ramon@hilpert.info',
                'SignupForm[password]' => 'Password#2019',
                'SignupForm[confirmPassword]' => 'Password#2019',
            ]
        );

        $I->seeRecord('app\models\User', ['username' => 'feest.ramon@hilpert.info']);

        // Make sure that the password is not saved as plain text
        $I->dontSeeRecord(
            'app\models\User',
            [
                'username' => 'feest.ramon@hilpert.info',
                'password_hash' => 'Password#2019'
            ]
        );

        // Sing in as newly registered user
        $I->seeInCurrentUrl('site/login');
        $I->seeInTitle('Sign In');
        $I->submitForm(
            '#login-form',
            [
                'LoginForm[username]' => 'feest.ramon@hilpert.info',
                'LoginForm[password]' => 'Password#2019',
            ]
        );

        $I->seeInTitle('Customers');
    }
}
