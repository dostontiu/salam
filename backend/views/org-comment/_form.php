<?php

use common\models\Organization;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OrgComment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="org-comment-form  col-md-8 col-md-offset-2">
    <div class="kt-portlet">
    <?php $form = ActiveForm::begin(); ?>
        <div class="kt-portlet__body">
            <?= $form->field($model, 'org_id')->dropDownList(ArrayHelper::map(Organization::find()->all(), 'id', 'name_ru'), ['prompt'=>'Выберите организацию']) ?>
            <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>
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
