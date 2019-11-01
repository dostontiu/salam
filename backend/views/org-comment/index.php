<?php

use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\OrgCommentQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Комментарии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="org-comment-index">
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
                        <a href="<?=Yii::$app->homeUrl?>org-comment/create" class="btn btn-brand btn-icon-sm">
                            <i class="flaticon2-plus"></i> Добавить
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-portlet__body">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items}<div class="kt-datatable__pager kt-datatable--paging-loaded">{pager}<div class="kt-datatable__pager-info">{summary}</div></div>',
        'tableOptions' => ['class' => 'table kt-datatable__table'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title:ntext',
            [
                'attribute' => 'org_id',
                'value' => 'organization.name_ru',
            ],
            [
                'attribute' => 'user_id',
                'value' => 'user.username',
                'filter' => User::find()->select(['username', 'id'])->indexBy('id')->column(),
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt' => 'Все'
                ],
            ],
            'date',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'status', [0=> 'Активный', 1=>'Неактивный'], ['class'=>'form-control','prompt' => 'Все']),
                'value' => function($model){
                    return $model->status==1 ? '<span class="bg-primary">Активный</span>' : '<span class="bg-danger">Неактивный</span>';
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'headerOptions' => ['style' => 'color:#5867dd'],
                'template' => '{change-status}{update}{delete}',
                'buttons' => [
                    'change-status' => function ($url, $model) {
                    return Html::a('<span class="la la-lg la-plus"></span>', $url, [
                        'title' => 'Изменить статус',
                        'aria-label' => Yii::t('app', 'Удаление'),
                        'data-confirm' => Yii::t('app', 'Вы уверены, что хотите изменить статус ?'),
                        'data-method' => 'post',
                        ]);
                    },
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
                    },

                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
