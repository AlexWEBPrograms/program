<?php

use yii\db\Migration;

/**
 * Handles the creation of table `city`.
 */
class m170302_120729_create_city_table extends Migration
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
        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'name' =>$this->string(100)->notNull()->comment('Місто'),
            'region_id'=>$this->integer()->notNull(),
        ],$tableOptions);
        $this->batchInsert('{{%city}}',['name','region_id'],[
           ['name'=>'Полонне','region_id'=>1],['name'=>'Понінка','region_id'=>1],
        ]);
    }
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('city');
    }
}
