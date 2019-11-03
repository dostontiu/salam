<?php
namespace common\models;

use \mdm\admin\models\User as UserModel;
use Yii;
use yii\base\Exception;
use yii\base\NotSupportedException;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property string $access_token
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends UserModel
{

    public function generateEmailVerificationToken()
    {
        try {
            $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
        } catch (Exception $e) {
        }
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token, 'status' => self::STATUS_ACTIVE]);
    }

    public function generateAccessToken()
    {
        try {
            $this->access_token = Yii::$app->security->generateRandomString();
        } catch (Exception $e) {
        }
    }

    public function fields()
    {
        return [
            'id',
            'username',
            'email',
            'status',
        ];
    }
}
