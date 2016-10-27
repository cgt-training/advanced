<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Company;

/**
 * CompanySearch represents the model behind the search form about `frontend\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id'], 'integer'],
            [['c_name', 'c_email', 'c_add', 'c_start_date', 'c_create_date', 'c_status'], 'safe'],
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
        $query = Company::find();

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
            'c_id' => $this->c_id,
            'c_start_date' => $this->c_start_date,
            'c_create_date' => $this->c_create_date,
        ]);

        $query->andFilterWhere(['like', 'c_name', $this->c_name])
            ->andFilterWhere(['like', 'c_email', $this->c_email])
            ->andFilterWhere(['like', 'c_add', $this->c_add])
            ->andFilterWhere(['like', 'c_status', $this->c_status]);

        return $dataProvider;
    }
}
