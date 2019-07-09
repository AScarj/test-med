<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TestTube */

$this->title = 'Создание пробирки';
$this->params['breadcrumbs'][] = ['label' => 'Пробирки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-tube-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
