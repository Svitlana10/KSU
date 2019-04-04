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
            [['id', 'breed_id', 'months', 'type_id', 'status', 'created_at', 'updated_at'], 'integer'],
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
     *
     * @return ActiveDataProvider
     */
    public function search()
    {
        $query = Dog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        foreach ($this->attributes as $key => $attribute) {
            if(isset($attribute) && !empty(trim($attribute))) {
                $query->andFilterWhere(['like', $key, $attribute]);
            }
        }

        return $dataProvider;
    }
}
