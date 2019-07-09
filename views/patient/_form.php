<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Patient */
/* @var $form yii\widgets\ActiveForm */
/* @var $genders app\models\Patient::genders() */

?>

<div class="patient-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-sm-5">
            <?= $form->field($model, 'passport')->textInput(['maxlength' => 10]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'date_birth')->widget(DatePicker::className(), [
                'options' => ['placeholder' => 'Выберите дату...'],
                'language' => 'ru-RU',
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'orientation' => 'bottom right',
                    'autoclose' => true,
                ]
            ]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'gender')->dropDownList($genders,[
                'prompt' => 'Выберите пол...'
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
