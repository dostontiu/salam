<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form col-md-10 col-md-offset-1">
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="col-md-8">
                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'father_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'date_birth')->widget(DatePicker::className(), [
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]); ?>

                <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions'=>[
                        'allowedFileExtensions'=>['jpg','gif','png'],
                        'showUpload' => false,
                        'initialPreview' => [
                            ($model->image) ? Yii::$app->homeUrl.'uploads/profile/'.$model->image : null,
                        ],
                        'initialPreviewAsData' => ($model->image) ? true : false,
                        'initialCaption' => ($model->image) ? $model->image : false,
                    ],
                ]); ?>

            </div>

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
