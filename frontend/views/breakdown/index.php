<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Breakdown */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Breakdowns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breakdown-index">
    
    <p>
        <?= Html::a('Create Breakdown', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'style',
            'body',
            'drawsing',
            'description:ntext',
            // 'purchase_order_number',
            // 'delivery_date',
            // 'receive_date_1',
            // 'receive_date_2',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
