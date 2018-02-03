<?php

use yii\db\Migration;

/**
 * Handles the creation of table `type_abon`.
 */
class m170302_112902_create_type_abon_table extends Migration
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
        $this->createTable('{{%type_abon}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('Тип абонента'),
        ],$tableOptions);
        $this->batchInsert('{{%type_abon}}',['name'],[
            ['name'=>'PON'],['name'=>'WIFI'],['name'=>'Radio']
        ]);
    }
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('type_abon');
    }
}
