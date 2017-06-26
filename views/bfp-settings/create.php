<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BfpSettings */

$this->title = Yii::t('app', 'Create Bfp Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bfp Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bfp-settings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
