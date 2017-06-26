<?php
namespace rikcage\bfp;

use Yii;

/**
 * Renders several attributes in one grid column
 */
class BfpClass extends \yii\base\Module
{
    public $controllerNamespace = 'rikcage\bfp\controllers';
    public $theme = false;

    public function init()
    {
        parent::init();

        if ($this->theme) {
            Yii::$app->view->theme = new \yii\base\Theme($this->theme);
        }
    }

}
