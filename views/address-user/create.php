<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AddressUser */

$this->title = 'Создать связку Адрес-Пользователь';
$this->params['breadcrumbs'][] = ['label' => 'Связка Адреса-Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
