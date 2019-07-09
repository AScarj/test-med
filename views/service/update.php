<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Service */
/* @var $biomaterials app\models\Biomaterial */

$this->title = 'Изменение услуги: ' . $model->name_service;
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_service, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="service-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'biomaterials' => $biomaterials,
        'testTubeModels' => $testTubeModels,
        'testTubes' => $testTubes,
    ]) ?>

</div>
