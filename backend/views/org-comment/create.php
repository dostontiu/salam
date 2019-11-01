<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OrgComment */

$this->title = 'Создать комментарий';
$this->params['breadcrumbs'][] = ['label' => 'Org Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="org-comment-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
