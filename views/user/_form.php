<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\widgets\MaskedInput;

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <label class="control-label">Дата рождения</label>
    <?= DatePicker::widget([
            'name' => 'birth',
            'value' => date('d-M-Y'),
            'options' => ['placeholder' => 'Выберите дату ...'],
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'format' => 'dd-M-yyyy',
                'todayHighlight' => true
                ]
            ])
    ?>
    <br>

    <?= $form->field($model, 'sex')->textInput()->dropDownList($model->sexname) ?>

    <?= $form->field($model, 'phone_number')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+7 (999) 999 99 99',
    ]); ?>
        <?php //->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
