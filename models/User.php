<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $birth
 * @property int $sex
 * @property string $phone_number
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['birth'], 'safe'],
            [['sex'], 'integer'],
            [['name'],'unique','targetClass'=>'app\models\User','targetAttribute'=>['name','surname']],
            [['name', 'surname', 'phone_number'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'birth' => 'Дата рождения',
            'sex' => 'Пол',
            'phone_number' => 'Номер телефона',
        ];
    }

    public function getSexName(){
        return ['Мужской','Женский'];
    }
}
