<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Biomaterial */
/* @var $testTubes app\models\TestTube */

$this->title = 'Изменить биоматериал: ' . $model->name_biomaterial;
$this->params['breadcrumbs'][] = ['label' => 'Биоматериал', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_biomaterial, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="biomaterial-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'testTubes' => $testTubes,
    ]) ?>

</div>
