<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\SignupForm;

/**
 * @var $model app\models\SignupForm
 */

$this->title = Yii::t('app', 'Sign Up');
?>

<div class="login-container">

    <?php
        $form = ActiveForm::begin([
            'id' => 'signup-form',
            'options' => ['autocomplete' => 'off'],
        ]);
    ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(\Yii::t('app', 'Username')) ?>

        <?= $form->field($model, 'password')->passwordInput()->label(\Yii::t('app', 'Password')) ?>

        <?= $form->field($model, 'confirmPassword')->passwordInput()->label(\Yii::t('app', 'Confirm Password')) ?>

        <?= Html::submitButton(\Yii::t('app', 'Sign up'), ['class' => 'btn btn-primary btn-block', 'name' => 'signup-button']) ?>

    <?php ActiveForm::end(); ?>

</div>
