<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->params['hide_div_container'] = false;

/* @var $this yii\web\View */
/* @var $model common\models\CheckPay */
/* @var $form ActiveForm */

$session = Yii::$app->session;
if (!$session->isActive){
	$session->open();
}

if(isset($session['bfp_return_url'])){
	$return_url = $session['bfp_return_url'];
}else{
	$return_url = Url::home();
}

?>

<div class="site-index">
    <div class="text-center navbar-btn btn-xs">
		<br>
        <p>
            Вам необходимо подтвердить переход на страницу:
        </p>
		<?= ''?>
        <p><a class="btn btn-lg btn-warning slide-btn" href="<?= $return_url?>">Перейти на страницу</a></p>
    </div>
</div>
