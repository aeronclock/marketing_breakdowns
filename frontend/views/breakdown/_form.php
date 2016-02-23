<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Breakdown */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="breakdown-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
      <div class="col-md-6">
        
        <?= $form->field($model, 'customer_id')->dropDownList($customers, ['prompt' => '- Pilih Customers -'])->label('Customer') ?>
        
        <?= $form->field($model, 'style')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'body')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'drawsing')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'delivery_date')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter a date ...'],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd',
            ]
        ]);?>
        
      </div>
      
      <div class="col-md-6">
        
        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        
        <?= $form->field($model, 'purchase_order_number')->textInput(['maxlength' => true]) ?>
        
        
        <?php 
        echo '<label class="control-label">Receive - Select date range</label>';
        echo DatePicker::widget([
          'model' => $model,
          'attribute' => 'receive_date_1',
          'attribute2' => 'receive_date_2',
          'options' => ['placeholder' => 'Start date'],
          'options2' => ['placeholder' => 'End date'],
          'type' => DatePicker::TYPE_RANGE,
          'form' => $form,
          'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,
          ]
        ]);
        ?>
        
      </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
