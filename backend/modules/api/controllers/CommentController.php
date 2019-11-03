<?php

namespace app\modules\api\controllers;

use common\models\OrgComment;
use common\models\User;
use Yii;

class CommentController extends ApiActiveController
{
    public $modelClass = 'common\models\OrgComment';

    public function actionCreate()
    {
        $model = new OrgComment();
        $model->user_id = $this->userId();
        $model->title = Yii::$app->request->getQueryParams()['title'];
        $model->org_id = (integer)Yii::$app->request->getQueryParams()['org_id'];

        return $model->save() ? $model : ['status' => false, 'error' => $model->getErrors()];
    }

    protected function userId()
    {
        return User::findIdentityByAccessToken(substr( $_SERVER['HTTP_AUTHORIZATION'], 7))->getId();
    }
}