<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AddressUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Связка Адрес-Пользователь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать связку Пользователь-Адрес', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'ID',
                'headerOptions' => ['width' => '50'],
                'content'=>function($data){
                    return $data->id;
                }
            ],

            'address_id',
            'user_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'headerOptions' => ['width' => '80'],
                'template' => '<div style="text-align: center">{update}{delete}{link}</div>',
                'buttons' => [
                    'update' => function ($url) {
                        return '<a href="'.$url.'" style="padding-left: 6px; padding-right: 6px;"><span class="glyphicon glyphicon-pencil"></span></a>';
                    },
                    'delete' => function ($url) {
                        return '<a href="'.$url.'" style="padding-left: 6px; padding-right: 6px;"><span class="glyphicon glyphicon-trash"></span></a>';
                    },
                ],
            ],

        ],
    ]); ?>
</div>
