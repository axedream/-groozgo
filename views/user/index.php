<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
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
            'name',
            'surname',
            [
                'attribute'=>'birth',
                'filter'=> FALSE,

                'content'=>function($data){
                    return $data->birth;
                }
            ],

            [
                'attribute'=>'sex',
                //'filter'=> FALSE,
                'filter'=>$searchModel->sexname,
                'content'=>function($data){
                    return $data->sexname[$data->sex];
                }

            ],

            //'phone_number',

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
