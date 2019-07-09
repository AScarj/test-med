<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceTestTube */

$this->title = 'Create Service Test Tube';
$this->params['breadcrumbs'][] = ['label' => 'Service Test Tubes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-test-tube-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
