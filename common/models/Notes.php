<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "notes".
 *
 * @property int $id
 * @property int $user_id Пользователь
 * @property string $title Заголовок
 * @property string|null $text Текст
 * @property int|null $created_at Создан
 * @property int|null $updated_at Изменен
 *
 * @property NotesTags[] $notesTags
 * @property User $user
 */
class Notes extends \yii\db\ActiveRecord
{
    public $tags;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['tags'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'tags' => 'Теги',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
        ];
    }

    /**
     * @inheritDoc
     */
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * Gets query for [[NotesTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotesTags()
    {
        return $this->hasMany(NotesTags::class, ['notes_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getRelatedTags()
    {
        return $this->hasMany(Tags::class, ['id' => 'tags_id'])->viaTable('{{%notes_tags}}', ['notes_id' => 'id']);
    }

    public function saveRelatedTags()
    {
        $relatedTags = Tags::findAll($this->tags);
        $this->unlinkAll('relatedTags', true);

        foreach ($relatedTags as $relatedTag) {
            $this->link('relatedTags', $relatedTag);
        }
    }
}
