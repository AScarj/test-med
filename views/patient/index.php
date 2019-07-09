<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пациенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить пациента', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'full_name',
            ['attribute' => 'passport'],
            ['attribute' => 'gender', 'value' => function($model){return \app\models\Patient::genders()[$model->gender];},
                'filter' => \app\models\Patient::genders()],
            ['attribute' => 'date_birth', 'filter' => DatePicker::widget([
                'model' => $searchModel,
                'attribute' => 'date_birth',
                'options' => ['placeholder' => 'Выберите дату...'],
                'language' => 'ru-RU',
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'orientation' => 'bottom right',
                    'autoclose' => true,
                ]
            ])],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
