<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Breakdown as BreakdownModel;

/**
 * Breakdown represents the model behind the search form about `app\models\Breakdown`.
 */
class Breakdown extends BreakdownModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['style', 'body', 'drawsing', 'description', 'purchase_order_number', 'delivery_date', 'receive_date_1', 'receive_date_2', 'created_at', 'updated_at'], 'safe'],
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
        $query = BreakdownModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'delivery_date' => $this->delivery_date,
            'receive_date_1' => $this->receive_date_1,
            'receive_date_2' => $this->receive_date_2,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'style', $this->style])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'drawsing', $this->drawsing])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'purchase_order_number', $this->purchase_order_number]);

        return $dataProvider;
    }
}
