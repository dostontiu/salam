<?php
namespace common\models;

use \mdm\admin\models\User as UserModel;
use Yii;
use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\helpers\Url;

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
 * @property string $type_social
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
        $fields = [
            'id',
            'username',
            'email',
            'type_social',
            'status',
        ];

        $fields['first_name'] = function ($model){ return $model->profile['first_name']; };
        $fields['last_name'] = function ($model){ return $model->profile['last_name']; };
        $fields['father_name'] = function ($model){ return $model->profile['father_name']; };
        $fields['date_birth'] = function ($model){ return $model->profile['date_birth']; };
        $fields['image'] = function ($model){ return (!$model->profile) ? null : Url::base(true).'/uploads/profile/'.$model->profile['image']; };
        $fields['telephone'] = function ($model){ return $model->profile['telephone']; };
        $fields['address'] = function ($model){ return $model->profile['address']; };

        return $fields;
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }
}
