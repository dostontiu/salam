<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */

$this->title = $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="profile-view">
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
                            'user_id',
                            'user.username',
                            'user.email',
                            'first_name',
                            'last_name',
                            'father_name',
                            'date_birth',
                            'telephone',
                            'address',
                            [
                                'attribute' => 'image',
                                'format' => 'html',
                                'value' => Html::img(Yii::$app->homeUrl.'uploads/profile/'.$model->image, ['style'=>'width:200px'])
                            ]
                        ],
                        ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
