<?php

namespace app\models\search;

use app\models\Address;
use app\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AddressUser;

/**
 * AddressUserSearch represents the model behind the search form of `app\models\AddressUser`.
 */
class AddressUserSearch extends AddressUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'address_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AddressUser::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $address = Address::findOne(['address'=>$this->address_id]);
        $address_id = $address[0]->id;

        $user = User::findOne(['name'=>$this->user_id]);
        $user_id = $user[0]->id;


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'address_id' => $address_id,
            'user_id' => $user_id,
        ]);

        return $dataProvider;
    }
}
