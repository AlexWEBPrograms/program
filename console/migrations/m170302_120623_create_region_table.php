<?php

use yii\db\Migration;

/**
 * Handles the creation of table `region`.
 */
class m170302_120623_create_region_table extends Migration
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
        $this->createTable('{{%region}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('Область'),
        ],$tableOptions);

        $this->batchInsert('{{%region}}',['name'],[
            ['name'=>'обл. Хмельницька'],['name'=>'обл. Житомирська'],['name'=>'обл. Баранівська'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('region');
    }
}
