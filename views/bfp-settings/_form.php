<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BfpSettings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bfp-settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'page_name')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-3">
		    <?= $form->field($model, 'form_time_submite')->textInput() ?>
        </div>
        <div class="col-md-3">
		    <?= $form->field($model, 'form_sleep')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
		    <?= $form->field($model, 'confirm_page')->textInput() ?>
        </div>
        <div class="col-md-3">
		    <?= $form->field($model, 'confirm_sleep')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
