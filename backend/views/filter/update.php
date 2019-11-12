<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Filter */

$this->title = Yii::t('app', 'Обновить филтер : {name}', [
    'name' => $model->name_ru,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Filters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="filter-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
