<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            ['attribute' => 'patient_id', 'value' => "patient.full_name"],
            ['attribute' => 'services', 'value' => function($model){
                $services = '';
                foreach ($model->servicesOrder as $service){
                    $services .= $service->name_service."<br>";
                }
                return $services;
            }, 'format' => "html"],
            'order_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
