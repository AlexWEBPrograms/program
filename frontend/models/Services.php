<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Cells[] $cells
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services';
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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Обладнення',
            'count'=>'Кількість'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCells()
    {
        return $this->hasMany(Cells::className(), ['services_id' => 'id']);
    }

    public function getCount()
    {
        return Cells::find()->where(['services_id'=>$this->id])->count();
    }
}
