<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TestTube */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-tube-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'test_tube_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
