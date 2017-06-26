<?php

//namespace common\models;
namespace rikcage\bfp\models;

use Yii;

/**
 * This is the model class for table "{{%bfp_settings}}".
 *
 * @property integer $bfp_id
 * @property string $page_name
 * @property integer $form_time_submite
 * @property integer $form_sleep
 * @property integer $confirm_page
 * @property integer $confirm_sleep
 */
class BfpSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bfp_settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_name'], 'required'],
            [['form_time_submite', 'form_sleep', 'confirm_page', 'confirm_sleep'], 'integer'],
            [['page_name'], 'string', 'max' => 512],
            [['page_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bfp_id' => Yii::t('app', 'Bfp ID'),
            'page_name' => Yii::t('app', 'Page Name'),
            'form_time_submite' => Yii::t('app', 'Form Time Submite'),
            'form_sleep' => Yii::t('app', 'Form Sleep'),
            'confirm_page' => Yii::t('app', 'Confirm Page'),
            'confirm_sleep' => Yii::t('app', 'Confirm Sleep'),
        ];
    }
}
