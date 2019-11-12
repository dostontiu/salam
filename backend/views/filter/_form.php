<?php

use common\models\Filter;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Filter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="filter-form col-md-6 col-md-offset-3">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Создайте новый
                </h3>
            </div>
        </div>
    <?php $form = ActiveForm::begin([
        'id' => 'filter-form',
        'options'=>['class'=>'kt-form'],
    ]); ?>
        <div class="kt-portlet__body">
            <?= $form->field($model, 'name_tj')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions kt-form__actions--right">
                <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-brand']) ?>
<!--                <button type="reset" class="btn btn-brand">Submit</button>-->
                <button type="reset" class="btn btn-secondary">Отмена</button>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>
