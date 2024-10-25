<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\authclient\widgets\AuthChoice;

$this->title = 'Войти';

?>
<div class="site-login">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <?= Html::encode($this->title) ?>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Sign in with:</p>

                        <?php $authAuthChoice = AuthChoice::begin([
                            'baseAuthUrl' => ['site/auth']
                        ]); ?>
                        <ul class="list-unstyled">
                            <?php foreach ($authAuthChoice->getClients() as $client): ?>
                                <li><?= $authAuthChoice->clientLink($client) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php AuthChoice::end(); ?>

                        <p class="text-center">or:</p>

                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <div class="my-1 mx-0" style="color:#999;">
                            <?= Html::a('Forgot password?', ['site/request-password-reset']) ?>.
                        </div>

                        <div class="d-grid gap-2">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
