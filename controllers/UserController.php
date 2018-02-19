<?php

namespace app\controllers;

use app\models\Address;
use app\models\AddressUser;
use Yii;
use app\models\User;
use app\models\search\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->delAddressUser($model->id);
            $this->addAddressUser($model->id);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Блок добавление связи адрес<->пользователь
     * @param $user_id
     */
    public function addAddressUser($user_id) {
        $input_id_address = Yii::$app->request->post('User')['input_id_address'];
        if ($input_id_address) {
            (new AddressUser)->setAddressUserFromUsers($input_id_address,$user_id);
        }
    }

    public function delAddressUser($user_id){
        $input_id_address = Yii::$app->request->post('User')['input_id_address_from_delete'];
        if ($input_id_address) {
            (new AddressUser)->delAddressUserFromUsers($input_id_address,$user_id);
        }
    }

    public function getAddressUser($user_id){
        $res = AddressUser::find()->where(['user_id'=>$user_id])->all();
        $out=[];
        if ($res) {
            foreach ($res as $addressUser) {
                $out[] = [
                    'id' => $addressUser->address_id ,
                    'address' => $addressUser->address->address
                ];
            }

        }
        return $out;
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->delAddressUser($model->id);
            $this->addAddressUser($model->id);
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model,
            'model_address_user' => $this->getAddressUser($model->id),
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
