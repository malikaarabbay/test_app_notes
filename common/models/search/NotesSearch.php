<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Notes;

/**
 * NotesSearch represents the model behind the search form of `common\models\Notes`.
 */
class NotesSearch extends Notes
{
    public $tag_id;
    public $sort;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'created_at', 'updated_at', 'tag_id'], 'integer'],
            [['title', 'text', 'sort'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Notes::find()->where(['user_id' => \Yii::$app->user->identity->id])
            ->leftJoin('notes_tags', 'notes_tags.notes_id = notes.id')
            ->leftJoin('tags', 'notes_tags.tags_id = tags.id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->tag_id) {
            $query->andWhere([
                'tags.id' => $this->tag_id,
                'notes_tags.tags_id' => $this->tag_id,
            ]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'notes.title', $this->title])
            ->andFilterWhere(['like', 'notes.text', $this->text]);

        if ($this->sort == 'asc') {
            $query->orderBy('notes.id ASC');
        }

        if ($this->sort == 'desc') {
            $query->orderBy('notes.id DESC');
        }

        return $dataProvider;
    }
}
