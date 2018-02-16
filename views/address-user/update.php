<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AddressUser */

$this->title = 'Изменить связку Адрес-Пользователь: ';
$this->params['breadcrumbs'][] = ['label' => 'Связки Адреса-Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="address-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
