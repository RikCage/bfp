<?php

//namespace common\models;
namespace rikcage\bfp\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use rikcage\bfp\models\BfpSettings;

/**
 * BfpSettingsSearch represents the model behind the search form about `common\models\BfpSettings`.
 */
class BfpSettingsSearch extends BfpSettings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bfp_id', 'form_time_submite', 'form_sleep', 'confirm_page', 'confirm_sleep'], 'integer'],
            [['page_name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = BfpSettings::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'bfp_id' => $this->bfp_id,
            'form_time_submite' => $this->form_time_submite,
            'form_sleep' => $this->form_sleep,
            'confirm_page' => $this->confirm_page,
            'confirm_sleep' => $this->confirm_sleep,
        ]);

        $query->andFilterWhere(['like', 'page_name', $this->page_name]);

        return $dataProvider;
    }
}
