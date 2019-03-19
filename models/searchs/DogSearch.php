<?php

namespace app\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dog;

/**
 * DogSearch represents the model behind the search form of `app\models\Dog`.
 */
class DogSearch extends Dog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'breed_id', 'months', 'type_id', 'created_at', 'updated_at'], 'integer'],
            [['dog_name', 'pedigree_number', 'owner'], 'safe'],
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
        $query = Dog::find();

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
            'breed_id' => $this->breed_id,
            'months' => $this->months,
            'type_id' => $this->type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'dog_name', $this->dog_name])
            ->andFilterWhere(['like', 'pedigree_number', $this->pedigree_number])
            ->andFilterWhere(['like', 'owner', $this->owner]);

        return $dataProvider;
    }
}
