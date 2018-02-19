<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\widgets\MaskedInput;


if ($model->birth) {
    $bd = explode('-',$model->birth);
    $model->birth = $bd[2].'.'.$bd[1].'.'.$bd[0];
}

$user_id = ($model->id) ? $model->id :  0;
$crfParam = Yii::$app->getRequest()->csrfParam;
$crfToken = Yii::$app->getRequest()->getCsrfToken();

$script = <<< JS


    /**
    * Помощник автодополнение строки адреса Yandex API 
    */
    ymaps.ready(init);
    function init() {
        // Подключаем поисковые подсказки к полю ввода.
        var suggestView = new ymaps.SuggestView('adding_address');    
    }
    /**
    * Отрубаем ENTER в форме дабы не было УПС 
    */
    $(".user-form form").keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
      }
    });

    /**
    * Ajax запрос добавления адреса (ожидаем ID: VALUE: )
    */
    function addAddres() {
        $.ajax({
            url: window.location.protocol + "//" + window.location.hostname + "/address-ajax/add-address",
            type: 'POST',
            dataType: 'JSON',
            beforeSend: function(){
                                
            },
            data: { output: { addadress : $("#adding_address").val(), user_id : $user_id  } },
            cache: false,
            success: function (msg) {
                if (!msg.error) {
                    $("#listing_address").append('<div id="div_adding_'+msg.outmsg.id+'"><input type="hidden" name="User[input_id_address]['+msg.outmsg.id+']" class="input_id_address" value="'+msg.outmsg.id+'"/><div class="col-md-10">'+msg.outmsg.address+'</div><div class="col-md-2"><a class="btn btn-danger delAddressUser" el_id="'+msg.outmsg.id+'">DEL</a></div></div>')
                    onDel();
                }
                //console.log(msg);
            }
        });      
    }

    /**
    * Удаляем адрес 
    */
    function onDel(){
        $(".delAddressUser").on('click',function(e){
            var user_id = $(this).attr('el_id');
            if ($('#listing_address_from_delete input[name="User[input_id_address_from_delete]['+user_id+']"').val() != user_id) {
                $("#div_adding_"+user_id).remove(); //удаляем физически элемент
                $("#listing_address_from_delete").append('<input type="hidden" name="User[input_id_address_from_delete]['+user_id+']" class="input_id_address" value="'+user_id+'"/>'); //ставим на удаление в перехват    
            }
            e.preventDefault();
            return false;             
        });
    }
    
    /**
    * Добавляем адрес 
    */
    $("#add-address-button").on('click',function(e){
        addAddres();
        e.preventDefault();
        return false;
    });
    onDel();
    
JS;

$this->registerJs($script, yii\web\View::POS_READY);


?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'id',['options' => ['tag' => false], 'template' => '{input}'])->hiddenInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <label class="control-label">Дата рождения (mm.dd.Y)</label>
    <?= DatePicker::widget([
            'model' => $model,
            'attribute' => 'birth',
            'language' => 'ru',
            'options' => [
                'placeholder' => 'Выберите дату ...'
            ],
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'format' => 'dd.mm.yyyy',
                'todayHighlight' => true,
                ]
            ]);
    ?>
    <br>

    <?= $form->field($model, 'sex')->textInput()->dropDownList($model->sexname) ?>

    <?= $form->field($model, 'phone_number')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+7 (999) 999 99 99',
    ]); ?>
        <?php //->textInput(['maxlength' => true]) ?>


    <div>
        <div class="form-group has-success" id="form_adding_address">
            <div class="row">
                <div class="col-md-2">Список адресов: </div>
                <div class="col-md-10" id="listing_address">
                    <?php if(is_array($model_address_user)) foreach($model_address_user as $au) {?>
                        <div id="div_adding_<?= $au['id'] ?>">
                            <input type="hidden" name="User[input_id_address][<?= $au['id'] ?>]" class="input_id_address" value="<?= $au['id'] ?>"/>
                            <div class="col-md-10"><?= $au['address'] ?></div>
                            <div class="col-md-2"><a class="btn btn-danger delAddressUser" el_id="<?= $au['id'] ?>">DEL</a></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row"><br></div>
            <label class="control-label" for="form_adding_address">Добавление адресов</label>
            <input type="text" id="adding_address" class="form-control" name="User[adding_address]" value="" maxlength="255" aria-invalid="false" />
            <div class="help-block"></div>
            <div class="row"><br></div>
            <div style="visibility: hidden" id="listing_address_from_delete">
            </div>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        <?= Html::button('Добавить адрес', ['class' => 'btn btn-success','id'=>'add-address-button']) ?>
    </div>



    <?php ActiveForm::end(); ?>


</div>
