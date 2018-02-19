<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 16.02.2018
 * Time: 12:18
 */

namespace app\controllers;



use phpDocumentor\Reflection\Types\Null_;
use Yii;
use app\models\Address;
use yii\web\Controller;
use yii\web\Response;
use yii\db\Query;


class AddressAjaxController extends Controller
{

    public $out = ['error'=>true, 'msg'=>'Неизвестно','code'=>FALSE];

    public function init(){
        Yii::$app->response->format = Response::FORMAT_JSON;;
    }

    public function actionGetAddress($q = null){
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

    /**
     * Добавление адресс через пользователя
     * @return array
     */
    public function actionAddAddress(){
        if (Yii::$app->request->isPost) {
            $user_id = Yii::$app->request->post('output')['user_id'];
            $addadress = Yii::$app->request->post('output')['addadress'];
            $data = $this->getAddress($addadress);
            if (!$data) {
                $ad = new Address();
                $ad->address = $addadress;
                $ad->save();
                $data = ['address' => $addadress,'id'=>$ad->id];
            }
            $this->out = ['error'=>false,'outmsg'=>$data];
        }
        return $this->out;
    }

    /**
     * Проверяет адресс и если есть возвращает массив адрес  + Id
     * @param bool $addadress
     * @return array|bool
     */
    public function getAddress($addadress=FALSE){
        if ($addadress) {
            $find_address = Address::findOne(['address'=>$addadress]);
            if ($find_address) {
                return ['address' => $find_address->address,  'id' => $find_address->id];
            }
        }
        return FALSE;
    }

}