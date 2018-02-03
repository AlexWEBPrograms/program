<?php

use yii\db\Migration;

/**
 * Handles the creation of table `street`.
 */
class m170302_120810_create_street_table extends Migration
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
        $this->createTable('{{%street}}', [
            'id' => $this->primaryKey(),
            'name' =>$this->string(100)->notNull()->comment('Вулиця'),
            'city_id'=>$this->integer()->notNull(),
        ],$tableOptions);
        $this->batchInsert('{{%street}}',['name','city_id'],
            [['name'=>'Лазо','city_id'=>1],['name'=>'Лугова','city_id'=>1],['name'=>'Попова','city_id'=>1]]
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('street');
    }
}
