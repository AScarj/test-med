<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Biomaterial */
/* @var $form yii\widgets\ActiveForm */
/* @var $testTubes app\models\TestTube */
?>

<div class="biomaterial-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_biomaterial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'test_tube_id')->dropDownList($testTubes, ['prompt' => 'Выберите пробирку...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
