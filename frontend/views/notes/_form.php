<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\Notes $model */
/** @var common\models\Tags $tags */
/** @var yii\widgets\ActiveForm $form */

$script = <<< JS
    $(document).ready(function() {
    $('.multiple-select2').select2();
});
JS;
$this->registerJs($script);
?>

<div class="notes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
        'clientOptions' => [
            'filebrowserBrowseUrl' => '/elfinder/manager?filter=image&'
        ]
    ]) ?>

    <?= $form->field($model, 'tags')
        ->dropDownList(ArrayHelper::map($tags, 'id', 'title'),
            [
                'multiple'=>'multiple',
                'class'=>'form-control multiple-select2',
            ]
        );  ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
