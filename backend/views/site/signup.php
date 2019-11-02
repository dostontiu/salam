<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kt-login__container">
    <div class="kt-login__logo">
        <a href="<?= Yii::$app->homeUrl?>">
            <img src="<?= Yii::$app->homeUrl?>admin/media/logos/logo-5.png">
        </a>
    </div>
    <div class="kt-login__signup" style="display: block;">
        <div class="kt-login__head">
            <h3 class="kt-login__title"><?= Html::encode($this->title) ?></h3>
            <div class="kt-login__desc">Введите свои данные, чтобы создать учетную запись</div>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'kt-form']]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->input('username', ['placeholder' => "Имя пользователя"])->label(false) ?>
        <?= $form->field($model, 'email')->input('email', ['placeholder' => "Электронное письмо"])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput()->input('password', ['placeholder' => "Пароль"])->label(false) ?>
        <?php //echo $form->field($model, 'password')->passwordInput()->input('password', ['placeholder' => "Подтвердить Пароль"])->label(false) ?>

        <div class="row kt-login__extra">
            <div class="col kt-align-right">
                <?= Html::a('Войти с другим логином', ['site/login'], ['class' => 'kt-link kt-login__link kt-font-bold'])?>
            </div>
        </div>
        <div class="kt-login__actions">
            <?= Html::submitButton('Регистрация', ['class' => 'btn btn-brand btn-pill kt-login__btn-primary', 'name' => 'signup-button']) ?>
            <?= Html::resetButton('Отмена', ['class' => 'btn btn-secondary btn-pill kt-login__btn-secondary', 'name' => 'signup-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
