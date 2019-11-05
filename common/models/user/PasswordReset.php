<?php

namespace common\models\user;

use mdm\admin\components\UserStatus;
use mdm\admin\models\form\PasswordResetRequest;
use mdm\admin\models\User;
use Yii;

class PasswordReset extends PasswordResetRequest
{
    public function sendToEmail()
    {
        $user = User::findOne([
            'status' => UserStatus::ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            $new_password = rand(111111,999999);
            $user->setPassword($new_password);
            $user->generateAuthKey();

            if ($user->save()) {
                Yii::$app->mailer->compose('passwordResetToken-html', ['new_password' => $new_password, 'user' => $user->username])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo($this->email)
                ->setSubject('Password reset for ' . Yii::$app->name)
                ->send();
                return true;
            }
        }
        return false;
    }
}