<?php

use common\models\Category;
use common\models\OrgFilter;
use common\models\Region;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii2mod\rating\StarRating;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\OrganizationQuery */
/* @var $filterFilter backend\controllers\OrganizationController */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Организации');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-index">
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
                        <a href="<?=Yii::$app->homeUrl?>organization/create" class="btn btn-brand btn-icon-sm">
                            <i class="flaticon2-plus"></i> Добавить
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-portlet__body">



            <!--begin: Datatable -->

            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout' => '{items}<div class="kt-datatable__pager kt-datatable--paging-loaded">{pager}<div class="kt-datatable__pager-info">{summary}</div></div>',
                'tableOptions' => ['class' => 'table kt-datatable__table'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'fullName:html',
                    'allType:html',
                    [
                        'attribute' => 'region_id',
                        'label' => 'Область',
                        'filter' => Region::find()->select(['name_ru', 'id'])->indexBy('id')->column(),
                        'filterInputOptions' => [
                            'class' => 'form-control',
                            'prompt' => 'Все'
                        ],
                        'value' => 'region.name_ru'
                    ],
                    [
                        'attribute' => 'rating',
                        'format' => 'text',
                        'content' => function($model){
                            return StarRating::widget([
                                'name' => 'input_name',
                                'value' => $model->rating,
                                'clientOptions' => [
                                    'readOnly' => true,
                                ],
                            ]);
                        },
                        'filter' =>  Html::activeDropDownList(
                            $searchModel,
                            'rating',
                            array(1=>"1 +",2=>"2+",3=>"3+",4=>"4+",5=>"5+"),
                            ['class'=>'form-control','prompt' => 'Все']
                        ),
                    ],
                    [
                        'attribute' => 'filter',
                        'headerOptions' => ['style' => 'color:#5867dd'],
                        'filter' =>  Html::activeDropDownList(
                            $searchModel,
                            'filter',
                            $filterFilter,
                            ['class'=>'form-control','prompt' => 'Все']
                        ),
                        'format' => 'raw',
                        'value' => function($model){
                            $data_filter = OrgFilter::find()->with('filter')->where(['organization_id' => $model->id])->all();
                            $hh = '';
                            foreach ($data_filter as $item) {
                                $hh .= '-'.$item->filter->name_ru.'<br>';
                            }
                            return $hh;
                        }
                    ],
                    [
                        'attribute' => 'category_id',
                        'value' => 'category.name_ru',
                        'filter' => Category::find()->select(['name_ru', 'id'])->indexBy('id')->column(),
                        'filterInputOptions' => [
                            'class' => 'form-control',
                            'prompt' => 'Все'
                        ],
                    ],
//                    [
//                        'attribute' => 'Фото',
//                        'headerOptions' => ['style' => 'color:#5867dd'],
//                        'format' => 'raw',
//                        'value' => function ($model) {
//                            if (file_exists('uploads/'.$model->photo)){
//                                return Html::img(Yii::$app->homeUrl. 'uploads/'.$model->photo, ['style'=>'width:100px']);
//                            } else {
//                                return Html::img(Yii::$app->homeUrl. 'uploads/nophoto.png', ['style'=>'width:100px']);
//                            }
//                        },
//                    ],
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

            <?php Pjax::end(); ?>
            </div>
            <!--end: Datatable -->
        </div>
    </div>


</div>
