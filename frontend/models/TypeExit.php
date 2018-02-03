<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_exit".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Cells[] $cells
 */
class TypeExit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type_exit';
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Тип виїзду',
            'count' => 'Кількість абонентів',
        ];
    }
    public function unicity($attribute)
    {
        if(Region::find()->andFilterWhere(['name'=>$this->name])->one())
            $this->addError($attribute,' Тип виїзду є вже у базі');
    }
    public function getCount()
    {
        return Cells::find()->where(['type_exit_id'=>$this->id])->count();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCells()
    {
        return $this->hasMany(Cells::className(), ['type_exit_id' => 'id']);
    }
}
