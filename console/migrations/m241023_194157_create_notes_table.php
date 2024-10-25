<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notes}}`.
 */
class m241023_194157_create_notes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notes}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('Пользователь'),
            'title' => $this->string()->notNull()->comment('Заголовок'),
            'text' => $this->text()->comment('Текст'),
            'created_at' => $this->integer()->comment('Создан'),
            'updated_at' => $this->integer()->comment('Изменен'),
        ]);

        $this->createIndex('idx-notes-user_id', 'notes', 'user_id');
        $this->addForeignKey('fk-notes-user_id', 'notes', 'user_id',
            'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-notes-user_id', 'notes');
        $this->dropForeignKey('fk-notes-user_id', 'notes');
        $this->dropTable('{{%notes}}');
    }
}
