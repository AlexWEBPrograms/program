<?php

use yii\db\Migration;

/**
 * Handles the creation of table `services`.
 */
class m170302_121202_create_services_table extends Migration
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
        $this->createTable('{{%services}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('Обладнення'),
        ],$tableOptions);
        $this->batchInsert('{{%services}}',['name'],[
            ['name'=>'WIFI'],['name'=>'ONU+WIFI']
        ]);
    }
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('services');
    }
}
