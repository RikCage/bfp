<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\BfpSettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bfp Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bfp-settings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Bfp Settings'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'page_name',
            'form_time_submite',
            'form_sleep',
            'confirm_page',
            'confirm_sleep',

            ['class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => false,
                ]
            ],
			
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
