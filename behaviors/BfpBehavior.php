<?php
namespace rikcage\bfp\behaviors;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\helpers\Url;
use yii\helpers\BaseUrl;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\base\Controller;
use yii\helpers\ArrayHelper;
use rikcage\bfp\models\BfpSettings;

class BfpBehavior extends AttributeBehavior
{

	private $pages_bfp_settings;

	private function isProtectedPage() {
        $route = Yii::$app->getRequest()->resolve();
		$routePathTmp = explode('/', $route[0]);
		
		$actionVariant = array_pop($routePathTmp);
		
		$routePathTmp[] = $actionVariant;
		$routePathTmp = array_diff($routePathTmp, array(''));
		if(Yii::$app->controller->action->id != $actionVariant){
			$routePathTmp[] = Yii::$app->controller->action->id;
		}
		
		$routeVariant = null;
		foreach ($routePathTmp as $routePart) {
            $routeVariant .= (strlen($routeVariant))? '/' . $routePart: $routePart;
			$value = BfpSettings::findOne(['page_name'=>$routeVariant]);
            if ($value) {
				$value = ArrayHelper::toArray($value);
				$value['page_url_canonical'] = $routeVariant;
                return $value;
            }
        }
		return null;
	}
	
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction',
			Model::EVENT_BEFORE_VALIDATE => 'beforeValidate',
			Model::EVENT_AFTER_VALIDATE => 'afterValidate',
        ];
    }

    public function beforeAction($event)
    {
		$page_settings = $this->isProtectedPage();
		if($page_settings){
			
			$session = Yii::$app->session;
			if (!$session->isActive){
				$session->open();
			}

			if($page_settings['confirm_page'] && !$this->checkBfp()){
				if($page_settings['confirm_sleep']){
					sleep((int)$page_settings['confirm_sleep']);
				}
                
				$url = Url::to('');
				$session['bfp_return_url'] = $url;
				
	            Yii::$app->response->redirect(['/bfp']);
				return;
				
			}else{
				if(isset($session['bfp_return_url'])){
					unset($session['bfp_return_url']);
				}
			}
			if($page_settings['form_time_submite']){
				$this->startBfpTime($page_settings['page_url_canonical']);
			}
		}else{
			$this->setBfp();
		}
		return;
    }

    public function beforeValidate($event)
    {
		$page_settings = $this->isProtectedPage();
		if($page_settings){
			if(!$this->checkBfpTime($page_settings['page_url_canonical'], $page_settings['form_time_submite'])){
				sleep((int)$page_settings['form_sleep']);
				$url = Url::to('');
				Yii::$app->response->redirect($url);
			}
			if($page_settings['form_sleep']){
				sleep((int)$page_settings['form_sleep']);
			}
		}
		return;
    }

    public function afterValidate($event)
    {
		
		$errors = $event->sender->errors;
		if( empty($errors) || (is_array($errors) && !count($errors)) ){
			$page_settings = $this->isProtectedPage();
			$atribute = $page_settings['page_url_canonical'];
			
			$session = Yii::$app->session;
			if (!$session->isActive){
				$session->open();
			}
			if(isset($session['bfp_check_time_'.$atribute])){
				unset($session['bfp_check_time_'.$atribute]);
				self::startBfpTime($atribute);
			}
		}
		return true;
    }
	
	public static function setBfp($atribute = '') {
		$session = Yii::$app->session;
		if (!$session->isActive){
			$session->open();
		}
		$session['bfp_check_'.$atribute] = 1;
	}
	
	public static function checkBfp($atribute = '')
    {
		$session = Yii::$app->session;
		if (!$session->isActive){
			$session->open();
		}
		if(empty($session['bfp_check_'.$atribute])){
			self::setBfp($atribute);
			return false;
		}
		return true;
	}
	public static function startBfpTime($atribute = '')
    {
		$session = Yii::$app->session;
		if (!$session->isActive){
			$session->open();
		}
		if(empty($session['bfp_check_time_'.$atribute])){
			$session['bfp_check_time_'.$atribute] = time();
		}
	}

	public static function checkBfpTime($atribute = '', $time = 1)
    {
		$session = Yii::$app->session;
		if (!$session->isActive){
			$session->open();
		}
		if(empty($session['bfp_check_time_'.$atribute])){
			self::startBfpTime($atribute);
			return false;
		}else{
			if(time()-$session['bfp_check_time_'.$atribute] < $time){
				return false;
			}
			return true;
		}
	}
	
}
