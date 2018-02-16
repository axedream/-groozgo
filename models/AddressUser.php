<?php

namespace app\models;

use Yii;

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
            'address_id' => 'Address ID',
            'user_id' => 'User ID',
        ];
    }
}
