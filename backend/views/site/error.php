<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
$this->context->layout = 'main-login';
$this->title = $name;
?>
<div class="site-error">
    <h1 class="text-center">
        <a href="<?=Yii::$app->homeUrl?>" class="btn btn-outline-brand btn-pil btn-lg btn-wide text-center"><i class="fa fa-home"></i>Главная страница</a>
    </h1>
    <br>
    <br>
    <br>
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

</div>
