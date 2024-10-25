<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tags}}`.
 */
class m241023_194428_create_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tags}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->comment('Название'),
            'created_at' => $this->integer()->comment('Создан'),
            'updated_at' => $this->integer()->comment('Изменен'),
        ]);

        Yii::$app->db->createCommand()->batchInsert('tags', ['id', 'title'], [
            [1, 'Учеба'],
            [2, 'Работа'],
            [3, 'Дом'],
            [4, 'Личное'],
            [5, 'Здоровье'],
            [6, 'Идеи'],
            [7, 'Рекомендации'],
            [8, 'Кафе'],
            [9, 'Путешествия'],
            [10, '2024'],
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tags}}');
    }
}
