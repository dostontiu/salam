<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Region */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="region-form col-md-4 col-md-offset-4">
    <div class="kt-portlet">

        <?php $form = ActiveForm::begin([
            'id' => 'region-form',
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
