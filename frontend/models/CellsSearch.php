<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cells;

/**
 * CellsSearch represents the model behind the search form about `app\models\Cells`.
 */
class CellsSearch extends Cells
{
    /**
     * @inheritdoc
     */
    public $fullAddress;
    public function rules()
    {
        return [
            [['id', 'region_id', 'date_exit', 'date_reg', 'user_id'], 'integer'],
            [['pib', 'number', 'fullAddress','phone', 'remark', 'city_id', 'street_id', 'type_exit_id', 'type_abon_id', 'services_id'], 'safe'],
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
        $query = Cells::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);
        $dataProvider->setSort([
          'attributes' => [
            'fullAddress'=>[
                'asc'=> ['region_id'=>SORT_ASC,'city_id'=>SORT_ASC,'street_id'=>SORT_ASC,'number'=>SORT_ASC],
                'desc'=> ['region_id'=>SORT_DESC,'city_id'=>SORT_DESC,'street_id'=>SORT_DESC,'number'=>SORT_DESC],
                'label'=>'Full Address',
                'default'=>SORT_ASC
            ],
            'type_exit_id',
              'type_abon_id',
              'services_id',
              'remark',
              'phone',
              'checked'


    ]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('city');
        $query->joinWith('region');
        $query->joinWith('street');
        $query->joinWith('typeAbon');
        $query->joinWith('services');
        $query->joinWith('typeExit');
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'type_exit_id' => $this->type_exit_id,
            'type_abon_id' => $this->type_abon_id,
            'date_exit' => $this->date_exit,
            'date_reg' => $this->date_reg,
            'services_id' => $this->services_id,
            'user_id' => $this->user_id,
        ]);

        //->orFilterWhere(['like', 'city.name', $this->city_id])
        //->orFilterWhere(['like', 'street.name', $this->street_id])
        $query->andFilterWhere(['like', 'pib', $this->pib])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->orFilterWhere(['like', 'type_abon.name', $this->type_abon_id])
            ->orFilterWhere(['like', 'city.name', $this->fullAddress])
            ->orFilterWhere(['like', 'street.name', $this->fullAddress])
            ->orFilterWhere(['like', 'number', $this->fullAddress])
            ->orFilterWhere(['like', 'type_exit.name', $this->type_exit_id])
            ->orFilterWhere(['like', 'services.name', $this->services_id]);
        return $dataProvider;
    }
}
