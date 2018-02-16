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


?>

<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'address')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'address')->widget(Select2::classname(), [
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
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
