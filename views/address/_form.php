<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use kartik\select2\Select2;
use app\models\Address;
/* @var $this yii\web\View */
/* @var $model app\models\Address */
/* @var $form yii\widgets\ActiveForm */


$url = \yii\helpers\Url::to(['address-ajax/get-address']);

$addressDesc = empty($model->address) ? '' : Address::findOne($model->id)->address;
$js = <<< JS
ymaps.ready(init);

function init() {
    // Подключаем поисковые подсказки к полю ввода.
    var suggestView = new ymaps.SuggestView('address-address');    
}

JS;

$this->registerJs($js,yii\web\View::POS_READY);
?>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <!-- select2-suggest-container     select2-search__field -->

    <?php /* $form->field($model, 'address')->widget(Select2::classname(), [
        'initValueText' => $addressDesc, // set the initial display text
        'options' => ['placeholder' => 'Введите адресс ...'],
        'pluginOptions' => [
            'tags' => true,
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Подождите... Идет поиск...'; }"),
            ],
            'ajax' => [
                'url' => $url,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(address) { return address.text; }'),
            'templateSelection' => new JsExpression('function (address) { return address.text; }'),
        ],
    ]);*/
    ?>


    <!-- <input type="text" id="SSS" class="input" placeholder="Введите адрес"> -->



    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
