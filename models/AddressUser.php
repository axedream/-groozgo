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

}
