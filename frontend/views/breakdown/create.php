<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Breakdown */

$this->title = 'Create Breakdown';
$this->params['breadcrumbs'][] = ['label' => 'Breakdowns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breakdown-create">

    <?= $this->render('_form', [
        'model' => $model,
        'customers' => $customers,
    ]) ?>

</div>
