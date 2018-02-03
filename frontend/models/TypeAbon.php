<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_abon".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Cells[] $cells
 */
class TypeAbon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type_abon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'unicity'],
            [['name'], 'string', 'max' => 100],

        ];
    }
    public function unicity($attribute)
    {
        if(Region::find()->andFilterWhere(['name'=>$this->name])->one())
            $this->addError($attribute,' Тип абонента є вже у базі');
    }
    public function getCount()
    {
        return Cells::find()->where(['type_exit_id'=>$this->id])->count();
    }
        /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Тип абонента',
            'count' => 'Кількість абонентів',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCells()
    {
        return $this->hasMany(Cells::className(), ['type_abon_id' => 'id']);
    }
}
