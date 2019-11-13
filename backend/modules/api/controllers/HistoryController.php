<?php

namespace app\modules\api\controllers;

use common\models\History;
use common\models\User;
use Yii;
use yii\filters\auth\HttpBearerAuth;

class HistoryController extends ApiActiveController
{
    public $modelClass = 'common\models\History';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);

    }

    public function actionCreate()
    {
        $data = Yii::$app->request->getQueryParams();
        if(empty($data['org_id'])){
            throw new \yii\web\BadRequestHttpException("Вы должны заполнить идентификатор организация");
        }

        $model = new History();
        $model->user_id = $this->userId();
        $model->org_id = (integer)$data['org_id'];

        return $model->save() ? $model : ['status' => false, 'error' => $model->getErrors()];
    }

    protected function userId()
    {
        return User::findIdentityByAccessToken(substr( $_SERVER['HTTP_AUTHORIZATION'], 7))->getId();
    }

    public function actionIndex()
    {
        $data = History::find()->where(['user_id' => $this->userId()])->all();
        return $data;
    }
}