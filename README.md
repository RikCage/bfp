# bfp

Brute force protect 

Install:

php composer.phar require rikcage/yii2-bfp "*"

php yii migrate --migrationPath=vendor/rikcage/yii2-bfp/migrations

Usage:

In conif add

		'bfp'=>[
			'class'=>'rikcage\bfp\BfpClass',
			'params' => [
				'accessRoles'=>['admin',], // role for admin page
			],
		],		

Admin url:
my.site/bfp/bfp-settings/index

In controller add

use rikcage\bfp\behaviors\BfpBehavior;

    public function behaviors()
    {
        return [
			'as BfpClass' => [
				'class' => BfpBehavior::className(),
			],
        ];
    }

In model add

use rikcage\bfp\behaviors\BfpBehavior;

    public function behaviors()
	{
			
		$parent_bahaviors = parent::behaviors();
	    $this_behaviors = [
			'as BfpClass' => [
				'class' => BfpBehavior::className(),
			],
        ];
        return array_merge($parent_bahaviors, $this_behaviors);

    }
