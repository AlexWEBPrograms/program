<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Cells[] $cells
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['name'], 'unicity'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function unicity($attribute)
    {

        if(Region::find()->andFilterWhere(['name'=>$this->name])->one())
                $this->addError($attribute,' Область є вже у базі');
    }
    public function getCount()
    {
        return City::find()->where(['region_id'=>$this->id])->count();
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Область',
            'count'=>'Кількість міст'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCells()
    {
        return $this->hasMany(Cells::className(), ['region_id' => 'id']);
    }
}
