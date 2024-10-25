<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property string $title Название
 * @property int|null $created_at Создан
 * @property int|null $updated_at Изменен
 *
 * @property NotesTags[] $notesTags
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
        ];
    }

    /**
     * Gets query for [[NotesTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotesTags()
    {
        return $this->hasMany(NotesTags::class, ['tags_id' => 'id']);
    }
}
