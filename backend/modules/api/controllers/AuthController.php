<?php

namespace app\modules\api\controllers;

use Yii;
use common\models\User;
use common\models\user\SignUpForm;
use common\models\user\ChangePassword;
use common\models\user\PasswordReset;
use yii\filters\auth\HttpBearerAuth;

class AuthController extends ApiActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'only' => ['change'],
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }


    public function verbs()
    {
        $verbs = parent::verbs();
        $verbs['register'] = ['POST'];
        $verbs['login'] = ['POST'];
        $verbs['social'] = ['POST'];
        $verbs['reset'] = ['POST'];
        $verbs['change'] = ['POST'];
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


    public function actionReset()
    {
        $data = Yii::$app->request->getQueryParams();
        if(empty($data['email'])){
            throw new \yii\web\BadRequestHttpException("Вы должны ввести имя пользователя, электронное почта");
        }

        $model = new PasswordReset();
        $model->email = $data['email'];

        if ($model->sendToEmail()){
            return [
                'status' => true,
                'message' => 'Ваш новый пароль отправлен по электронной почте'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Это электронной почта не существует наш система'
            ];
        }
    }


    public function actionChange()
    {
        $data = Yii::$app->request->getQueryParams();
        $auth = $_SERVER['HTTP_AUTHORIZATION'];
        if(empty($auth) || empty($data['old_password']) || empty($data['new_password'])  || empty($data['retype_password'])){
            throw new \yii\web\BadRequestHttpException("Вы должны ввести старый пароль, новый пароль, введите пароль еще раз");
        }
        $model = new ChangePassword();
        $model->accessToken = substr($auth, 7);
        $model->oldPassword = $data['old_password'];
        $model->newPassword = $data['new_password'];
        $model->retypePassword = $data['retype_password'];

        if ($model->change()){
            return [
                'status' => true,
                'message' => 'Ваш пароль изменен на '.$model->newPassword
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Пожалуйста, исправьте ошибку',
                'error' => $model->getErrors()
            ];
        }
    }
}