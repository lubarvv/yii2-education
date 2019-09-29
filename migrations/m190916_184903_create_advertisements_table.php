<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%advertisements}}`.
 */
class m190916_184903_create_advertisements_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%advertisements}}', [
            'id'          => $this->primaryKey(),
            'firstName'   => $this->string(),
            'lastName'    => $this->string(),
            'email'       => $this->string(),
            'phone'       => $this->string(),
            'title'       => $this->string(),
            'description' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%advertisements}}');
    }
}
