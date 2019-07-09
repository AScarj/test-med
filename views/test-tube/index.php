<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TestTubeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пробирки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-tube-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать пробирку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'test_tube_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
