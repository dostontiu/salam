<?php

use common\models\Category;
use common\models\Country;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form col-md-6 col-md-offset-3">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Создайте новый
                </h3>
            </div>
        </div>
    <?php $form = ActiveForm::begin([
        'id' => 'category-form',
        'options'=>['class'=>'kt-form'],
    ]); ?>
        <div class="kt-portlet__body">
            <?= $form->field($model, 'name_tj')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'image')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions'=>[
                    'allowedFileExtensions'=>['jpg','gif','png'],
                    'showUpload' => false,
                    'initialPreview' => [
                        ($model->icon) ? Yii::$app->homeUrl.'uploads/'.$model->icon : null,
                    ],
                    'initialPreviewAsData' => ($model->icon) ? true : false,
                    'initialCaption' => ($model->icon) ? $model->icon : false,
                ],
            ]); ?>

    </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions kt-form__actions--right">
                <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-brand']) ?>
                <button type="reset" class="btn btn-secondary">Отмена</button>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>
