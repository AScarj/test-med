<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Service */
/* @var $biomaterials app\models\Biomaterial */

$this->title = 'Создание услуги';
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'biomaterials' => $biomaterials,
        'testTubeModels' => $testTubeModels,
        'testTubes' => $testTubes,
    ]) ?>

</div>
