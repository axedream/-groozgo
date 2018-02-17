<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Address;
use app\models\User;
/* @var $this yii\web\View */
/* @var $model app\models\AddressUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $form->field($model, 'address_id')->textInput() ?>

    <div style="margin-bottom: 15px;">
        <label class="control-label">Адрес</label>
        <?= Select2::widget([
            'model' => $model,
            'attribute' => 'address_id',
            'data' => ArrayHelper::map(Address::find()->asArray()->all(), 'id', 'address'),
            'theme' => Select2::THEME_BOOTSTRAP,
            'hideSearch' => false,
            'maintainOrder' => true,
            'options' => [
                'placeholder' => 'Выберите адрес...',
                'multiple' => false,
            ],
        ]);
        ?>
    </div>

    <div style="margin-bottom: 15px;">
        <label class="control-label">Пользователь</label>
        <?= Select2::widget([
            'model' => $model,
            'attribute' => 'user_id',
            'data' => ArrayHelper::map(User::find()->asArray()->all(), 'id', 'name'),
            'theme' => Select2::THEME_BOOTSTRAP,
            'hideSearch' => false,
            'maintainOrder' => true,
            'options' => [
                'placeholder' => 'Выберите пользователя...',
                'multiple' => false,
            ],
        ]);
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
