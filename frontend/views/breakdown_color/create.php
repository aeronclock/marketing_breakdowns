<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BreakdownColor */
/* @var $form ActiveForm */
$this->title = "Create Color - ".$breakdown->customer->name.' - '.$breakdown->style;
$this->params['breadcrumbs'][] = ['label' => 'Breakdowns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Breakdown', 'url' => ['view', 'id' => $breakdown->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breakdown_color-create">
  <div class="row">
    <div class="col-md-6">
      <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
      
      <?= $form->field($model, 'breakdown_id')->hiddenInput(['value' => $breakdown->id])->label(false) ?>
      <?= $form->field($model, 'color_name') ?>
      <?= $form->field($model, 'excel_file')->fileInput() ?>
      
      <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancel', ['view', 'id' => $breakdown->id], ['class' => 'btn btn-warning']) ?>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>

</div><!-- breakdown_color-create -->
