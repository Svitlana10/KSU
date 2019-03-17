<?php

namespace app\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DogShow;

/**
 * DogShowSearch represents the model behind the search form of `app\models\searchs\DogShow`.
 */
class DogShowSearch extends DogShow
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'show_date', 'start_reg_date', 'end_reg_date', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['tile', 'description', 'address', 'img'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = DogShow::find();

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
            'id' => $this->id,
            'show_date' => $this->show_date,
            'start_reg_date' => $this->start_reg_date,
            'end_reg_date' => $this->end_reg_date,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'tile', $this->tile])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'img', $this->img]);

        return $dataProvider;
    }
}
