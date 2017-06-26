<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BfpSettings */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Bfp Settings',
]) . $model->bfp_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bfp Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update').' (id:'.$model->bfp_id.') '.$model->page_name;
?>
<div class="bfp-settings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
