<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BiomaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Биоматериал';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biomaterial-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить биоматериал', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name_biomaterial',
            ['attribute' => 'test_tube_id', 'value' => 'testTube.test_tube_name'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
