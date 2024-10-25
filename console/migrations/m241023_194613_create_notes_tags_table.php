<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notes_tags}}`.
 */
class m241023_194613_create_notes_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notes_tags}}', [
            'id' => $this->primaryKey(),
            'notes_id' => $this->integer()->notNull()->comment('Заметка'),
            'tags_id' => $this->integer()->notNull()->comment('Теги'),
        ]);

        $this->createIndex('idx-notes_tags-notes_id', 'notes_tags', 'notes_id');
        $this->addForeignKey('fk-notes_tags-notes_id', 'notes_tags', 'notes_id',
            'notes', 'id');

        $this->createIndex('idx-notes_tags-tags_id', 'notes_tags', 'tags_id');
        $this->addForeignKey('fk-notes_tags-tags_id', 'notes_tags', 'tags_id',
            'tags', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-notes_tags-notes_id', 'notes_tags');
        $this->dropForeignKey('fk-notes_tags-notes_id', 'notes_tags');

        $this->dropIndex('idx-notes_tags-tags_id', 'notes_tags');
        $this->dropForeignKey('fk-notes_tags-tags_id', 'notes_tags');

        $this->dropTable('{{%notes_tags}}');
    }
}
