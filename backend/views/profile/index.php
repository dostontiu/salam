<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProfileQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Профили';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">
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
                    <a href="<?=Yii::$app->homeUrl?>" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        назад
                    </a>
                    &nbsp;
                    <div class="dropdown dropdown-inline">
                        <a href="<?=Yii::$app->homeUrl?>profile/create" class="btn btn-brand btn-icon-sm">
                            <i class="flaticon2-plus"></i> Добавить
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-portlet__body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'layout' => '{items}<div class="kt-datatable__pager kt-datatable--paging-loaded">{pager}<div class="kt-datatable__pager-info">{summary}</div></div>',
                    'tableOptions' => ['class' => 'table kt-datatable__table'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'attribute' => 'user_id',
                            'format' => 'raw',
                            'value' => function($model){
                                return Html::a($model->user->username, ['profile/view', 'id' => $model->id]);
                            },
                            'label' => 'Имя пользователя',
                            'filter' => false
                        ],
                        'first_name',
                        'last_name',
                        'father_name',
                        'date_birth',
                        'telephone',
                        'address',
//                        'image',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Действия',
                            'headerOptions' => ['style' => 'color:#5867dd'],
                            'template' => '{update}{delete}',
                            'buttons' => [
                                'update' => function ($url, $model) {
                                    return Html::a('<span class="la la-lg la-edit"> </span>', $url, [
                                        'title' => Yii::t('app', 'update'),
                                    ]);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<span class="la la-lg la-trash"> </span>', $url, [
                                        'title' => Yii::t('app', 'delete'),
                                        'aria-label' => Yii::t('app', 'Удаление'),
                                        'data-confirm' => Yii::t('app', 'Вы уверены, что хотите удалить данное заведение?'),
                                        'data-method' => 'post',
                                    ]);
                                }

                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
