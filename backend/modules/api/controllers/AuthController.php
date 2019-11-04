<?php

namespace app\modules\api\controllers;

use common\models\User;
use common\models\user\SignUpForm;
use Yii;

class AuthController extends ApiActiveController
{
    public $modelClass = 'common\models\User';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function verbs()
    {
        $verbs = parent::verbs();
        $verbs['login'] = ['POST'];
        $verbs['register'] = ['POST'];
        return $verbs;
    }

    public function actionLogin()
    {
        $data = Yii::$app->request->getQueryParams();
        if(empty($data['username']) || empty($data['password'])){
            throw new \yii\web\BadRequestHttpException("Вы должны ввести имя пользователя и пароль");
        }
        $user = User::findByUsername($data['username']);
        if ($user){
            $check_password = Yii::$app->getSecurity()->validatePassword($data['password'], $user->password_hash);
            if ($check_password){
                return [
                    'status' => true,
                    'message' => 'Вы вошли в систему',
                    'access_token' => $user->access_token,
                ];
            }
        }
        return [
            'status' => false,
            'message' => 'Неправильное имя пользователя или пароль'
        ];
    }

    public function actionRegister(){
        $model = new SignupForm();
        $data = Yii::$app->request->getQueryParams();
        if(empty($data['username']) || empty($data['email']) || empty($data['password'])){
            throw new \yii\web\BadRequestHttpException("Вы должны ввести имя пользователя, электронное почта и пароль");
        }
        $model->username = $data['username'];
        $model->email = $data['email'];
        $model->password = $data['password'];

        if ($model->signup()){
            return [
                'status' => true,
                'message' => 'Спасибо за регистрацию',
                'access_token' => User::findByUsername($model->username)->access_token,
            ];
        } else {
            return $model->getErrors();
        }
    }

    public function actionSocial()
    {
        $data = Yii::$app->request->getQueryParams();
        if(empty($data['username']) || empty($data['email']) || empty($data['password']) || empty($data['type_social']) ){
            throw new \yii\web\BadRequestHttpException("Социальный тип : электронное почта, социальный тип и пароль");
        }

        if (isset($data['access_token']) && $model_user = User::findIdentityByAccessToken($data['access_token'])){
            return [
                'status' => true,
                'message' => 'Вы уже вошли в систему',
                'access_token' => $model_user->access_token,
            ];
        }
        $model = new SignupForm();
        $model->username = $data['username'];
        $model->email = $data['email'];
        $model->password = $data['password'];
        $model->type_social = $data['type_social'];

        if ($model->signup()){
            return [
                'status' => true,
                'message' => 'Спасибо за регистрацию с '.$data['type_social'],
                'access_token' => User::findByUsername($model->username)->access_token,
            ];
        } else {
            return $model->getErrors();
        }

    }
}