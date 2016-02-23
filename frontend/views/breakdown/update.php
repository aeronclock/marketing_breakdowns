<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Breakdown */

$this->title = 'Update Breakdown: ' . ' ' . $model->customer->name.' - '.$model->style;
$this->params['breadcrumbs'][] = ['label' => 'Breakdowns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->customer->name.' - '.$model->style, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="breakdown-update">

    <?= $this->render('_form', [
        'model' => $model,
        'customers' => $customers,
    ]) ?>

</div>
