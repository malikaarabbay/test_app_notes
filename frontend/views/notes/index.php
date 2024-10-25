<?php

use common\models\Notes;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\search\NotesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var common\models\Tags $tags */

$this->title = 'Заметки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notes-index">
    <div class="card">
        <div class="card-header">
            <h1 class="float-start"><?= Html::encode($this->title) ?></h1>
            <span class="float-end">
                <?= Html::a('Создать заметку', ['create'], ['class' => 'btn btn-success']) ?>
            </span>
        </div>
        <div class="card-body">
            <?php echo $this->render('_search', ['model' => $searchModel, 'tags' => $tags]); ?>
        </div>
    </div>
    <br>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
        'itemOptions' => ['tag' => false],
        'options' => [
            'tag' => false,
        ],
        'emptyText' => 'Список пуст',
        'emptyTextOptions' => [
            'tag' => 'p'
        ],
        'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
        'layout' => "<div class='row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3'>{items}</div><div class='clearfix'></div>\n{pager}",
    ]) ?>
</div>
