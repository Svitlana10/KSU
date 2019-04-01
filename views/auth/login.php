<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="login-page">
    <div class="form">
        <div class="login-form">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Будь ласка заповніть поля для авторизації:</p>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"text\">{input}</div>\n<div class=\"password\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],],]); ?>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div>{input} {label}</div>\n<div>{error}</div>",  ]) ?>
            <div class="form-group">

                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

            </div>
            <?php ActiveForm::end(); ?>


        </div>
    </div>
</div>


