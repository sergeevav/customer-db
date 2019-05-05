<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\LoginForm;

/**
 * @var $model app\models\LoginForm
 */

$this->title = Yii::t('app', 'Sign In');
?>

<div class="login-container">

    <?php
        $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['autocomplete' => 'off'],
        ]);
    ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(\Yii::t('app', 'Username')) ?>

        <?= $form->field($model, 'password')->passwordInput()->label(\Yii::t('app', 'Password')) ?>

        <?= Html::submitButton(\Yii::t('app', 'Sign in'), ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>

    <?php ActiveForm::end(); ?>

    <div class="login-container-register">
        <?= Yii::t('app', 'Not registered yet?') ?>
        <?= Html::a(Yii::t('app', 'Sign up'), ['site/signup']) ?>
    </div>

</div>
