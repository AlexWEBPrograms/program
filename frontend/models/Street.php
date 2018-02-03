<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "street".
 *
 * @property integer $id
 * @property string $name
 * @property integer $city_id
 * @property integer $coutn_number
 *
 * @property Cells[] $cells
 */
class Street extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'street';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'city_id'], 'required'],
            ['name', 'unicity'],
            [['city_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Вулиця',
            'city_id' => 'Місто',
            'count' => 'Кількість абонентів',
        ];
    }
    public function unicity($attribute)
    {

        if(Street::find()->andFilterWhere(['name'=>$this->name])->one())
            if(City::find()->andFilterWhere(['id'=>$this->city_id])->one())
                $this->addError($attribute,' Вулиця є вже у базі  в цьому місті');


    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCells()
    {
        return $this->hasMany(Cells::className(), ['street_id' => 'id']);
    }

    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    public function getCount()
    {
        return Cells::find()->where(['street_id'=>$this->id])->count();
    }
}
