<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'patient_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Patient::find()->asArray()->all(), 'id', 'full_name'), ['prompt' => "Выберите пациента"]) ?>

    <?php
    if ($model->servicesOrder){                                                                                            //Формирование массива с установленными категориями у записи
        foreach ($model->servicesOrder as $service){
            $model->services[] = $service->id;                                                                              //Записываем все id категории
        }
    }

    echo $form->field($model, 'services')->widget(Select2::className(),[
        'data' =>  \yii\helpers\ArrayHelper::map(\app\models\Service::find()->asArray()->all(), 'id', 'name_service'),
        'language' => 'ru',
        'options' => ['multiple' => true, 'placeholder' => 'Выберите услуги'],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [',', ' '],
            //'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'order_date')->widget(\kartik\date\DatePicker::className(), [
        'options' => ['placeholder' => 'Выберите дату...'],
        'language' => 'ru-RU',
        'type' => \kartik\date\DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'orientation' => ' left',
            'autoclose' => true,
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
