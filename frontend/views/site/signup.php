<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Регистрация';
?>
<div class="site-signup">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <?= Html::encode($this->title) ?>
                    </div>
                    <div class="card-body">
                    <p>Please fill out the following fields to signup:</p>

                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'email') ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <div class="d-grid gap-2">
                            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
