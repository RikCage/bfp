<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BfpSettingsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bfp-settings-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bfp_id') ?>

    <?= $form->field($model, 'page_name') ?>

    <?= $form->field($model, 'form_time_submite') ?>

    <?= $form->field($model, 'form_sleep') ?>

    <?= $form->field($model, 'confirm_page') ?>

    <?php // echo $form->field($model, 'confirm_sleep') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
