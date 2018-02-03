<?php

use yii\db\Migration;

/**
 * Handles the creation of table `type_exit`.
 */
class m170302_112744_create_type_exit_table extends Migration
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
        $this->createTable('{{%type_exit}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('Тип виїзду'),
        ],$tableOptions);
        $this->batchInsert('{{%type_exit}}',['name'],
            [['name'=>'Ремонт'],['name'=>'Підключення'],['name'=>'Обстеження'],['name'=>'Відключення'],]
            );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('type_exit');
    }
}
