<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Notes $model */

?>
<div class="col">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title"><?= $model->title ?></h5>
            <p class="card-text"><?= $model->text ?></p>
            <?php if ($model->relatedTags) { ?>
                <span class="">Теги:</span>
                <?php foreach ($model->relatedTags as $tag) { ?>
                    <span class="badge text-bg-secondary"><?= $tag->title ?></span>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="card-footer">
            <div class="float-end">
                <?= Html::a(Html::encode(' Изменить'), ['update', 'id' => $model->id], ['class' => 'btn btn-outline-dark btn-sm']); ?>
            </div>
        </div>
    </div>
</div>
