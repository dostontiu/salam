<?php

namespace app\modules\api\controllers;

use common\models\OrgComment;
use common\models\User;
use Yii;
use yii\filters\auth\HttpBearerAuth;

class CommentController extends ApiActiveController
{
    public $modelClass = 'common\models\OrgComment';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'only' => ['create'],
        ];
        return $behaviors;
    }

    public function actionCreate()
    {
        $data = Yii::$app->request->getQueryParams();
        if(empty($data['title']) || empty($data['org_id'])){
            throw new \yii\web\BadRequestHttpException("Вы должны заполнить идентификатор организации и название");
        }

        $model = new OrgComment();
        $model->user_id = $this->userId();
        $model->title = $data['title'];
        $model->org_id = (integer)$data['org_id'];

        return $model->save() ? $model : ['status' => false, 'error' => $model->getErrors()];
    }

    protected function userId()
    {
        return User::findIdentityByAccessToken(substr( $_SERVER['HTTP_AUTHORIZATION'], 7))->getId();
    }
}