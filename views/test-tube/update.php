<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TestTube */

$this->title = 'Изменить пробирку: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Пробирки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="test-tube-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
