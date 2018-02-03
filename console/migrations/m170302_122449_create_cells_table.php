<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cells`.
 */
class m170302_122449_create_cells_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%cells}}', [
            'id' => $this->primaryKey(),
            'pib'=> $this->string()->comment('Прізвище Ім*я По батькові'),
            'region_id'=>$this->integer(11)->notNull()->comment('Область'),
            'city_id' => $this->integer(11)->notNull()->comment('Місто\село'),
            'street_id' => $this->integer(11)->notNull()->comment('Вулиця'),
            'number' => $this->string(6)->notNull()->comment('Номер'),
            'phone' => $this->string(21)->notNull()->comment('Номер телефону')->notNull(),
            'type_exit_id'=>$this->integer(11)->comment('Тип виїзду')->notNull(),
            'type_abon_id'=>$this->integer(11)->comment('Тип абонента')->notNull(),
            'date_exit'=>$this->integer()->comment('Дата виїзду')->notNull(),
            'date_reg'=>$this->integer()->comment('Дата реєстрування')->notNull(),
            'services_id'=>$this->integer(11)->comment('Обладнення')->notNull()->defaultValue(1),
            'remark'=>$this->text()->comment('Примітка'),
            'checked'=>$this->integer(1)->comment('Виконання')->defaultValue(0),
            'user_id'=>$this->integer(11)->comment('Користувач що зареєстрував'),
        ],$tableOptions);
        $this->createIndex(
            'idx-cells-type_exit',
            '{{%cells}}',
            'type_exit_id'
        );
        $this->createIndex(
            'idx-cells-services',
            '{{%cells}}',
            'services_id'
        );
        $this->createIndex(
            'idx-cells-type_abon',
            '{{%cells}}',
            'type_abon_id'
        );
        $this->createIndex(
            'idx-cells-user_id',
            'cells',
            'user_id'
        );
        $this->createIndex(
            'idx-cells-address_id',
            '{{%cells}}',
            'street_id'
        );
        $this->createIndex(
            'idx-cells-region_id',
            '{{%cells}}',
            'region_id'
        );
        $this->createIndex(
            'idx-cells-city_id',
            '{{%cells}}',
            'city_id'
        );
        $this->addForeignKey(
            'fk-cells-region-id',
            '{{%cells}}',
            'region_id',
            'region',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-cells-exit-id',
            '{{%cells}}',
            'type_exit_id',
            'type_exit',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-cells-abon-id',
            '{{%cells}}',
            'type_abon_id',
            'type_abon',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-cells-city-id',
            '{{%cells}}',
            'city_id',
            'city',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-cells-street-id',
            '{{%cells}}',
            'street_id',
            'street',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-cells-user-id',
            '{{%cells}}',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-cells-services-id',
            '{{%cells}}',
            'services_id',
            'services',
            'id',
            'CASCADE'
        );
        $this->insert(
            '{{%cells}}',[
                'pib'=>'',
                'services_id'=>1,
                'region_id'=>1,
                'city_id' =>1,
                'phone' =>'232323',
                'street_id' =>1,
                'number'=>'23a',
                'type_exit_id'=>1,
                'type_abon_id'=>1,
                'date_exit'=>1213223,
                'date_reg'=>321424,
                'remark'=>'Alex cool',
                'user_id'=>1
            ]
        );
        $this->insert(
            '{{%cells}}',[
                'pib'=>'',
                'services_id'=>2,
                'region_id'=>2,
                'city_id' =>2,
                'phone' =>'232323',
                'street_id' =>2,
                'number'=>'24',
                'type_exit_id'=>2,
                'type_abon_id'=>2,
                'date_exit'=>1213223,
                'date_reg'=>321424,
                'remark'=>'Alex cool',
                'user_id'=>1
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%cells}}');
    }
}
