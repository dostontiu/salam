<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = 'Каталог : '.$model->name_ru;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="category-view">
    <div class="col-md-8 col-md-offset-2">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        <?=Html::encode($this->title)?>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <?= Html::a(Yii::t('app', 'Обновить'), ['update', 'id' => $model->id], ['class' => 'btn btn-brand btn-icon-sm']) ?>
                        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger btn-icon-sm',
                            'data' => [
                                'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить данный?'),
                                'method' => 'post',
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-portlet__body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'options' => ['class' => 'table kt-datatable__table'],
                        'attributes' => [
                            'id',
                            'name_tj',
                            'name_en',
                            'name_ru',
                            [
                                'attribute' => 'icon',
                                'format' => 'html',
                                'value' => Html::img(Yii::$app->homeUrl.'uploads/'.$model->icon, ['style'=>'width:100px'])
                            ]
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
