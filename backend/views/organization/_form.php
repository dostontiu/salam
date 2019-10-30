<?php

use common\models\Region;
use kartik\file\FileInput;
use msvdev\widgets\mappicker\MapInput;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii2mod\rating\StarRating;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $model common\models\Organization */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organization-form">
    <div class="kt-portlet">
        <?php $form = ActiveForm::begin([
            'id' => 'organization-form',
            'enableAjaxValidation' => false,
            'options'=>['enctype'=>'multipart/form-data', 'class'=>'kt-form kt-form--fit kt-form--label-right'],
        ]); ?>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-md-8">
                    <?php
                    echo Tabs::widget([
                        'items' => [
                            [
                                'label' => 'Таджикский',
                                'content' => $form->field($model, 'name_tj')->textInput(['maxlength' => true]).$form->field($model, 'type_tj')->textInput(['maxlength' => true]).$form->field($model, 'description_tj')->textarea(['rows' => '6']),
                                'options' => ['id' => 'tj'],
                                'active' => true,
                            ],
                            [
                                'label' => 'Руский',
                                'content' => $form->field($model, 'name_ru')->textInput(['maxlength' => true]).$form->field($model, 'type_ru')->textInput(['maxlength' => true]).$form->field($model, 'description_ru')->textarea(['rows' => '6']),
                                'options' => ['id' => 'ru'],
                            ],
                            [
                                'label' => 'Английский',
                                'content' => $form->field($model, 'name_en')->textInput(['maxlength' => true]).$form->field($model, 'type_en')->textInput(['maxlength' => true]).$form->field($model, 'description_en')->textarea(['rows' => '6']),
                                'options' => ['id' => 'en'],
                            ],
                        ],
                        'navType' => 'nav-fill nav-pills',
                        'headerOptions' => [
                            'class' => 'nav-item'
                        ],
                        'linkOptions' => [
                            'class' => 'nav-link text-dark'
                        ],
                    ]);
                    ?>

                    <?= $form->field($model, 'gps')->widget(
                        MapInput::className(),
                        [
                            'language' => 'ru-Ru', // map language, default is the same as in the app
                            'service' => 'yandex', // map service provider, "google" or "yandex", default "google"
                            //                    'apiKey' => '', // required google maps
                            //                    'coordinatesDelimiter' => '@', // attribute coordinate string delimiter, default "@" (lat@lng)
                            'mapWidth' => '100%', // width map container, default "500px"
                            'mapHeight' => '420px', // height map container, default "500px"
                            'mapZoom' => '10', // map zoom value, default "10"
                            'mapCenter' => [38.5612404, 68.6414967],

                        ]
                    );
                    ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'region_id')->dropDownList(ArrayHelper::map(Region::find()->all(), 'id', 'name_ru'), ['prompt' => 'Выберите регион'])->label(false) ?>

                    <?= $form->field($model, 'rating')->widget(StarRating::className(), [
                        'clientOptions' => [
                            'hints' => ['Плохо', 'бедных', 'регулярный', 'хороший', 'великолепный'],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'name_ru'), ['prompt' => 'Выберите категория'])?>

                    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
                        'options' => ['accept' => 'image/*'],
                        'pluginOptions'=>[
                            'allowedFileExtensions'=>['jpg','gif','png'],
                            'showUpload' => false,
                            'initialPreview' => [
                                ($model->photo) ? Yii::$app->homeUrl.'uploads/'.$model->photo : null,
                            ],
                            'initialPreviewAsData' => ($model->photo) ? true : false,
                            'initialCaption' => ($model->photo) ? $model->photo : false,
                        ],
                    ]); ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-brand btn-group-justified']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
