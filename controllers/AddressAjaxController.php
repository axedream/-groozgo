<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 16.02.2018
 * Time: 12:18
 */

namespace app\controllers;



use Yii;
use app\models\Address;
use yii\web\Controller;
use yii\web\Response;
use yii\db\Query;


class AddressAjaxController extends Controller
{

    public function actionGetAddress($q = null){
        Yii::$app->response->format = Response::FORMAT_JSON;
        /*
        $out = ['results' => ['id' => '', 'text' => '']];

        if (!is_null($q)) {

            $query = new Query;
            $query->select('id, address AS text')->from('address')->where(['like', 'address', $q])->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        */

            $out = ['result'=>[
                ['id'=>'0', 'text'=>'test1'],
                ['id'=>'1', 'text'=>'test2'],
                ['id'=>'2', 'text'=>'test3'],
                ],
            ];




        return $out;
    }


}