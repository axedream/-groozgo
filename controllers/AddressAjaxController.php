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

        $out = ['results' => ['id' => '', 'text' => '']];
        //либо результат из базы данных при отритцательном результате поиск будет проходить по yandex api через front
        if (!is_null($q)) {

            $query = new Query;
            $query->select('address as id, address AS text')->from('address')->where(['like', 'address', $q])->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }

        //file_put_contents("c:\\OpenServer\\domains\\hosting\\yii2.txt","\nВыводимые данные:\n\n".print_r($out,TRUE), FILE_APPEND | LOCK_EX );
        return $out;
    }


}