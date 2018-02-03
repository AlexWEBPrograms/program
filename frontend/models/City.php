<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $name
 * @property integer $region_id
 * @property integer $count_street
 *
 * @property Cells[] $cells
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'region_id'], 'required'],
            [['region_id'], 'integer'],
            [['name'], 'unicity'],
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
            'name' => 'Назва міста',
            'region_id' => 'Область',
            'count' => 'Кількість вулиць',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function unicity($attribute)
    {

        if(City::find()->andFilterWhere(['name'=>$this->name])->one())
            if(City::find()->andFilterWhere(['region_id'=>$this->region_id])->one())
            $this->addError($attribute,' Місто є вже у базі в цій облісті');


    }
    public function getCells()
    {
        return $this->hasMany(Cells::className(), ['city_id' => 'id']);
    }
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    public function getCount()
    {
        return Street::find()->where(['city_id'=>$this->id])->count();
    }
}
