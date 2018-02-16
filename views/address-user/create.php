<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AddressUser */

$this->title = 'Create Address User';
$this->params['breadcrumbs'][] = ['label' => 'Address Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
