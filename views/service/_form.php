<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Service */
/* @var $form yii\widgets\ActiveForm */
/* @var $biomaterials app\models\Biomaterial */
/* @var $testTubeModels app\models\ServiceTestTube */

$script = <<< JS

$( document ).ready(function() {
    
    var customField;
    
     $('.fields').on( "click", 'button.add-test-tube', function(event) {
 
        testTube = $(this).parent().parent().clone();                                                                //Находим блок с общими полями и клонируем его
        
        $(this).parent().parent().find('.delete-button-block').show();                                                  //Показываем у текущего блока, кнопку удаления
        $(this).parent().parent().find('.add-button-block').remove();                                                   //Удаляем у текущего блока, кнопку с копированием
        
        $(testTube).find("select").val("");                                                                 //Очищаем содержимое полей
        
        numberForm = parseInt($(testTube).find(".test_tube-block select").attr("id").replace(/\D/g, ''), 10);              //Получаем номер элемента по его id
        numberFormPlus = parseInt(numberForm, 10) + 1;                                                                  //Прибавляем 1 к текущему номеру
        
        console.log(numberForm);
        console.log(numberFormPlus);
        
        $(testTube).find(".test_tube-block div.form-group").removeClass('field-servicetesttube-'+numberForm+'-test_tube').addClass('field-servicetesttube-'+ numberFormPlus +'-test_tube');         //Удаляем у клонированного элемента класс и добавляем новый класс с +1
        $(testTube).find(".test_tube-block div.form-group label").attr("for", "servicetesttube-"+numberFormPlus+"-test_tube");                                                             //Присваиваем новый параметр for  с +1
        $(testTube).find(".test_tube-block div.form-group select").attr("id", "servicetesttube-"+numberFormPlus+"-test_tube").attr("name", "ServiceTestTube["+numberFormPlus+"][test_tube]");        //Присваиваем новый id и name c +1
        
        $(testTube).find(".delete-button-block button.delete-custom-field").attr("data", "");
        
        $(".fields").append(testTube);                                                                               //Вставляем клонированный элемент в конец поля field
    });
     
     
     
      $('.fields').on( "click", 'button.delete-test-tube', function(event) {
       
        event.preventDefault();
        testTubeId = $(this).attr('data');
        
        if(testTubeId === ""){
            $(this).parent().parent().remove();
        } else {
            
            $.ajax({
                type:'POST',
                url: 'delete-service-test-tube',
                data: {testTubeId: $(this).attr('data')},
                dataType: "json",
                beforeSend: function() { $('#page-preloader').show();},
                complete: function(){ $('#page-preloader').hide(); },
                success  : function(data) {
                    
                   $('.alert').text(data.message).show();
                   $('html, body').animate({scrollTop: 0},500);
                    
                    setTimeout(function () {
                        location.reload();
                    }, 2500);
                }
            });
        }
    });
    
});


JS;

$this->registerJs($script, yii\web\View::POS_READY);
?>

<div class="alert alert-success" role="alert" style="display: none;">
</div>

<div class="service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_service')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'biomaterial_id')->dropDownList($biomaterials, ['prompt' => "Выберите биоматериал"]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <h2>Пробирки</h2>
    <div class="fields">
        <?php foreach ($testTubeModels as $key => $testTubeModel) : ?>
            <div class="row test-tube">
                <div class="col-md-11 test_tube-block">
                    <?php echo $form->field($testTubeModel, "[$key]test_tube")->dropDownList($testTubes, ['prompt' => 'Выберите пробирку...']) ?>
                </div>

                <?php if(++$key == count($testTubeModels)) : ?>
                    <div class="col-md-1 delete-button-block" style="display: none;">
                        <label class="control-label">Удалить</label>
                        <button type="button" class="btn btn-danger delete-test-tube" data="<?= $testTubeModel->id ?>">-</button>
                    </div>
                    <div class="col-md-1 add-button-block">
                        <label class="control-label">Добавить</label>
                        <button type="button" class="btn btn-primary add-test-tube">+</button>
                    </div>
                <?php else : ?>
                    <div class="col-md-1 delete-button-block">
                        <label class="control-label">Удалить</label>
                        <button type="button" class="btn btn-danger delete-test-tube" data="<?= $testTubeModel->id ?>">-</button>
                    </div>
                <?php endif; ?>
            </div>
        <?endforeach; ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div id="page-preloader"><span class="spinner"></span></div>
