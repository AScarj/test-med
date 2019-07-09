<?php

namespace app\models\search;

use app\models\TestTube;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Service;

/**
 * ServiceSearch represents the model behind the search form of `app\models\Service`.
 */
class ServiceSearch extends Service
{

    public $testTube;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'biomaterial_id'], 'integer'],
            [['name_service', /*'testTube'*/], 'safe'],
            [['price'], 'number'],
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
        $query = Service::find();

        //$query->joinWith(['testTubes']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

//        $dataProvider->sort->attributes['testTube'] = [
//            'asc' => [TestTube::tableName().'.test_tube_name' => SORT_ASC],
//            'desc' => [TestTube::tableName().'.test_tube_name' => SORT_DESC],
//        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'biomaterial_id' => $this->biomaterial_id,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['ilike', 'name_service', $this->name_service])
            /*->andFilterWhere(['like', TestTube::tableName().'.test_tube_name', $this->testTube])*/;

        return $dataProvider;
    }
}
