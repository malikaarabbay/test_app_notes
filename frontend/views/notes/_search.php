<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\search\NotesSearch $model */
/** @var yii\widgets\ActiveForm $form */
/** @var common\models\Tags $tags */

?>

<div class="notes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'title') ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'text') ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'tag_id')->dropDownList($tags, ['prompt' => 'Выберите тег'])->label('Теги') ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'sort')->dropDownList([
                    'asc' => 'sort ASC',
                    'desc' => 'sort DESC',
                ])->label('Сортировка');
            ?>
        </div>
    </div>

    <br>
    <div class="form-group">
        <div class="float-end">
            <?= Html::submitButton('Search', ['class' => 'btn btn-outline-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
