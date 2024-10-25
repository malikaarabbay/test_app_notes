<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Notes $model */
/** @var common\models\Tags $tags */

$this->title = 'Создать заметку';
$this->params['breadcrumbs'][] = ['label' => 'Заметки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notes-create">
    <div class="card">
        <div class="card-header">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
                'tags' => $tags
            ]) ?>
        </div>
    </div>
</div>
