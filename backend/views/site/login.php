<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход в систему';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kt-login__container">
    <div class="kt-login__logo">
        <a href="<?= Yii::$app->homeUrl?>">
            <img src="<?= Yii::$app->homeUrl?>admin/media/logos/logo-5.png">
        </a>
    </div>
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title"><?= Html::encode($this->title) ?></h3>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'options'=>['class'=>'kt-form'],]); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder'=>'Логин'])->label(false) ?>
                <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Пароль'])->label(false) ?>
                <?= $form->field($model, 'rememberMe')->checkbox(['class'=>'kt-checkbox'])->label('Запомнить?') ?>
            <div class="kt-login__actions">
                <?= Html::submitButton('Войти', ['id'=>'kt_login_signin_submit', 'class' => 'btn btn-brand btn-pill kt-login__btn-primary', 'name' => 'login-button']) ?>
            </div>
            <div class="kt-login__account">
                <span class="kt-login__account-msg">У вас еще нет аккаунта?</span>&nbsp;&nbsp;
                <?= Html::a('Регистрация!', ['site/signup'], ['class' => 'kt-login__account-link'])?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

