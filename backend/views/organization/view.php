<?php

use msvdev\widgets\mappicker\MapInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii2mod\rating\StarRating;

/* @var $this yii\web\View */
/* @var $model common\models\Organization */

$this->title = 'Организацию : ' . $model->name_ru;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
function rate($id)
{
    return StarRating::widget([
        'name' => 'input_name',
        'value' => $id,
        'clientOptions' => [
            'readOnly' => true,
        ],
    ]);
}


?>
<div class="organization-view">

    <div class="col-md-6">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
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
                            [
                                'attribute' => 'user_id',
                                'value' => $model->user->username,
                            ],
                            [
                                'attribute' => 'region_id',
                                'value' => $model->region->name_ru,
                            ],
                            [
                                'attribute' => 'category_id',
                                'value' => $model->category->name_ru,
                            ],
                            [
                                'attribute' => 'rating',
                                'value' => rate($model->rating),
                                'format' => 'raw'
                            ],
                            'gps',
                            'name_tj',
                            'name_en',
                            'name_ru',
                            'type_tj',
                            'type_en',
                            'type_ru',
                            'description_tj:html',
                            'description_en:html',
                            'description_ru:html',
                            'photo',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <!--begin:: Widgets/Support Tickets -->
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Комментарии</h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-widget3">
                    <?php foreach ($model->orgComments as $comment): ?>
                        <div class="kt-widget3__item">
                            <div class="kt-widget3__header">
                                <div class="kt-widget3__user-img">
                                    <img class="kt-widget3__img" src="<?= Yii::$app->homeUrl ?>uploads/profile/avatar.png">
                                </div>
                                <div class="kt-widget3__info">
                                    <a href="#" class="kt-widget3__username"><?= $comment->user->username ?></a><br>
                                    <span class="kt-widget3__time"><?= $comment->date ?></span>
                                </div>
                                <span class="kt-widget3__status kt-font-info kt-switch kt-switch--lg kt-switch--icon">
                                    <!--<label>
                                        <input type="checkbox" checked="checked" name="acti">
                                        <span></span>
                                    </label>-->
                                </span>
                            </div>
                            <div class="kt-widget3__body">
                                <p class="kt-widget3__text"><?= Html::encode($comment->title) ?></p>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>

        <!--end:: Widgets/Support Tickets -->
    </div>
    <div class="col-md-6">
        <div class="kt-portlet kt-portlet--height-fluid kt-widget19">
            <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">
                <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides"
                     style="min-height: 500px; border-radius: 4px; background-size: contain; background-image: url(<?= Yii::$app->homeUrl . 'uploads/' . $model->photo ?>)">
                    <h3 class="kt-widget19__title kt-font-light"><?= $model->name_ru ?></h3>
                    <div class="kt-widget19__shadow"></div>
                </div>
            </div>
        </div>

        <div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Место нахождения</h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-widget15">
                    <?php $form = ActiveForm::begin();
                    echo $form->field($model, 'gps')->widget(
                        MapInput::className(),
                        [
                            'language' => 'ru-RU', // map language, default is the same as in the app
                            'service' => 'yandex', // map service provider, "google" or "yandex", default "google"
                            'mapWidth' => '100%', // width map container, default "500px"
                            'mapHeight' => '400px', // height map container, default "500px"
                            'mapZoom' => '12', // map zoom value, default "10"
//                            'mapCenter' => [55.753338, 37.622861], // coordinates center map with an empty attribute, default Moscow
                        ]
                    )->label(false);
                    ActiveForm::end();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
