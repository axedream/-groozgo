<?php

namespace app\models;

use Yii;
use app\models\Address;
use app\models\User;
/**
 * This is the model class for table "address_user".
 *
 * @property int $id
 * @property int $address_id
 * @property int $user_id
 */
class AddressUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address_id' => 'Адрес',
            'user_id' => 'Пользователь',
        ];
    }

    /**
     * Адрес
     * @return \yii\db\ActiveQuery
     */
    public function getAddress(){
        return $this->hasOne(Address::className(),['id'=>'address_id']);
    }

    /**
     * Пользователь
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }


    public function delAddressUserFromUsers($address_id=FALSE,$users_id=FALSE) {
        if (is_array($address_id) && is_numeric($users_id)) {
            $add ='';
            $i=0;
            foreach ($address_id as $address){
                if (!$i) {
                    $add = '("'.$address.'"';
                } else {
                    $add .= ',"'.$address.'"';
                }
                $i++;
            }
            $add .=')';
            $where =' user_id = "'.$users_id.'" AND address_id IN '.$add;
            //file_put_contents("c:\\OpenServer\\domains\\hosting\\yii2.txt","\nВыводимые данные:\n\n".print_r($obj,TRUE), FILE_APPEND | LOCK_EX );
            if(AddressUser::deleteAll($where)) return TRUE;
        }
        return FALSE;
    }

    /**
     * Содание связи через массив адресов
     * @param bool $address_id
     * @param bool $users_id
     * @return bool
     */
    public function setAddressUserFromUsers($address_id=FALSE,$users_id=FALSE)
    {
        if (is_array($address_id) && is_numeric($users_id)) {
            foreach ($address_id as $address){
                //проверка на существование текущей связки
                if (!AddressUser::findOne(['user_id'=>$users_id,'address_id'=>$address])) {
                    $obj = new AddressUser();
                    $obj->address_id = $address;
                    $obj->user_id = $users_id;
                    $obj->save();
                    unset($obj);
                }

            }
            return TRUE;
        }
        return FALSE;
    }

}
