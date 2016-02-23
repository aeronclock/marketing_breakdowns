<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\Breakdown */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="breakdown-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'style') ?>

    <?= $form->field($model, 'body') ?>

    <?= $form->field($model, 'drawsing') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'purchase_order_number') ?>

    <?php // echo $form->field($model, 'delivery_date') ?>

    <?php // echo $form->field($model, 'receive_date_1') ?>

    <?php // echo $form->field($model, 'receive_date_2') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
