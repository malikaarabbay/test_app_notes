<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notes_tags".
 *
 * @property int $id
 * @property int $notes_id Заметка
 * @property int $tags_id Теги
 *
 * @property Notes $notes
 * @property Tags $tags
 */
class NotesTags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes_tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['notes_id', 'tags_id'], 'required'],
            [['notes_id', 'tags_id'], 'integer'],
            [['notes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notes::class, 'targetAttribute' => ['notes_id' => 'id']],
            [['tags_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::class, 'targetAttribute' => ['tags_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notes_id' => 'Заметка',
            'tags_id' => 'Теги',
        ];
    }

    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasOne(Notes::class, ['id' => 'notes_id']);
    }

    /**
     * Gets query for [[Tags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasOne(Tags::class, ['id' => 'tags_id']);
    }
}
