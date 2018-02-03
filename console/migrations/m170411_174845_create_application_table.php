<?php

use yii\db\Migration;

/**
 * Handles the creation of table `application`.
 */
class m170411_174845_create_application_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('application', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(21)->notNull()->comment('Номер телефону')->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('application');
    }
}
