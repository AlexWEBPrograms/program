<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cells".
 *
 * @property integer $id
 * @property string $pib
 * @property integer $region_id
 * @property integer $city_id
 * @property integer $street_id
 * @property string $number
 * @property string $phone
 * @property integer $type_exit_id
 * @property integer $type_abon_id
 * @property integer $date_exit
 * @property integer $date_reg
 * @property integer $services_id
 * @property string $remark
 * @property integer $checked
 * @property integer $user_id
 *
 * @property TypeAbon $typeAbon
 * @property City $city
 * @property TypeExit $typeExit
 * @property Region $region
 * @property Services $services
 * @property Street $street
 * @property User $user
 */
class Cells extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cells';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'city_id', 'street_id', 'number', 'phone',  'date_exit', 'date_reg', 'date_exit'], 'required'],
            [['region_id', 'city_id', 'street_id', 'type_exit_id','type_exit_id', 'type_abon_id', 'type_abon_id', 'services_id', 'checked', 'user_id'], 'integer'],
            [['remark'], 'string'],
            [['pib'], 'string', 'max' => 255],
            [['number'], 'string', 'max' => 6],
            [['phone'], 'string', 'max' => 21],
            [['type_abon_id'], 'exist', 'skipOnError' => true, 'targetClass' => TypeAbon::className(), 'targetAttribute' => ['type_abon_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['type_exit_id'], 'exist', 'skipOnError' => true, 'targetClass' => TypeExit::className(), 'targetAttribute' => ['type_exit_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['services_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['services_id' => 'id']],
            [['street_id'], 'exist', 'skipOnError' => true, 'targetClass' => Street::className(), 'targetAttribute' => ['street_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pib' => 'ПІБ',
            'region_id' => 'Область',
            'city_id' => 'Місто',
            'street_id' => 'Вулиця',
            'number' => 'Номер',
            'phone' => 'Телефон',
            'type_exit_id' => 'Тип виїзду',
            'type_abon_id' => 'Тип абонента',
            'date_exit' => 'Дата виїзду',
            'date_reg' => 'Дата реєстрації',
            'services_id' => 'Обладнення',
            'remark' => 'Примітка',
            'checked' => 'Виконано',
            'user_id' => 'Користувач',
            'fullAddress'=>'Адреса',
            'TextChecked'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeAbon()
    {
        return $this->hasOne(TypeAbon::className(), ['id' => 'type_abon_id']);
    }
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeExit()
    {
        return $this->hasOne(TypeExit::className(), ['id' => 'type_exit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasOne(Services::className(), ['id' => 'services_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStreet()
    {
        return $this->hasOne(Street::className(), ['id' => 'street_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getFullAddress()
    {
        return $this->city->name.' '.$this->street->name.' № '.$this->number;
    }

    public function getTypeAbonName()
    {
        return $this->typeAbon->name;
    }

    public function getChecked()
    {
        return $this->checked;
    }

    public function getTypeExitName()
    {
        return $this->typeExit->name;
    }

    public function getDate($date)
    {
        return strtotime($date);
    }

    public function getCheckeds()
    {
        return Street::find()->where(['city_id'=>1])->count();
    }

    public function  getCountChecked()
    {
        return (int)Cells::find()->where(['checked'=>1])->count();
    }

    public function getCountNotChecked()
    {
        return (int)Cells::find()->where(['checked' => 0])->count();
    }

    public function getCountTypeExit($id)
    {
        return (int)Cells::find()->where(['type_exit'=>$id])->count();
    }

    public function getTextCheched()
    {
        if($this->checked)
            return 'Виконано';
                else
                    return 'Не виконано';
    }
}
