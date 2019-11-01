<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OrgComment */

$this->title = 'Update Org Comment: ' . substr($model->title,0,20);
$this->params['breadcrumbs'][] = ['label' => 'Org Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="org-comment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
