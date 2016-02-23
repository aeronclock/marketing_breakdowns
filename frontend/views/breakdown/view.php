<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\models\Breakdown */

$this->title = $model->customer->name.' - '.$model->style;
$this->params['breadcrumbs'][] = ['label' => 'Breakdowns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breakdown-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-print"></i> Excel Reports', ['export-breakdown', 'id' => $model->id], ['class' => 'btn btn-default', 'target' => '_blank']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

<div class="row">
  <div class="col-md-4">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'style',
            'body',
            'drawsing',
            'purchase_order_number',
        ],
    ]) ?>
  </div>
  <div class="col-md-4">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'description:ntext',
            'delivery_date:date',
            'receive_date_1:date',
            'receive_date_2:date',
        ],
    ]) ?>
  </div>
  <div class="col-md-4">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          ['attribute' => 'created_by', 'value' => $model->userCreate->username],
          'created_at:date',
          ['attribute' => 'updated_by', 'value' => $model->userUpdate->username],
          'updated_at:date',
        ],
    ]) ?>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'Color',
                'content' => $this->render('_colors', ['model' => $model]),
                'active' => true
            ],
            // [
            //     'label' => 'Two',
            //     'content' => 'Anim pariatur cliche...',
            //     'options' => ['id' => 'myveryownID'],
            // ],
        ],
    ]); ?>
  </div>
</div>

</div>
