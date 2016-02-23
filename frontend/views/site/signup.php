<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';

$fieldOptions0 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Marketing</b> Breakdowns</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Please fill out the following fields to signup:</p>

        <div class="row">
            <div class="col-lg-12">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <?= $form->field($model, 'username', $fieldOptions0) ?>

                    <?= $form->field($model, 'email', $fieldOptions1) ?>

                    <?= $form->field($model, 'password', $fieldOptions2)->passwordInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary col-md-5', 'name' => 'signup-button']) ?>
                        <a href="login" class="btn btn-default col-md-3 pull-right">Cancel</a>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    
</div>
