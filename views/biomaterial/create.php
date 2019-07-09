<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Biomaterial */
/* @var $testTubes app\models\TestTube */

$this->title = 'Создать биоматериал';
$this->params['breadcrumbs'][] = ['label' => 'Биоматериал', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biomaterial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'testTubes' => $testTubes,
    ]) ?>

</div>
