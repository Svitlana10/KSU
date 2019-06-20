<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="container">
      <section>
        <div id="container_demo" >
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>
            <div id="wrapper">


                        <h1>Авторизація</h1>
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"text\">{input}</div>\n<div class=\"password\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],],]); ?>
                        <p>

                            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                        </p>
                        <p>

                            <?= $form->field($model, 'password')->passwordInput() ?>
                        </p>
                        <p class="keeplogin">

                            <?= $form->field($model, 'rememberMe')->checkbox([
                                'template' => "<div>{input} {label}</div>\n<div>{error}</div>",  ]) ?>
                        </p>
                        <p>
                            <div class="form-group">
                    <?= Html::submitButton('Вхід', ['class' => 'button']) ?>
                            </div>
                        </p>


                <?php ActiveForm::end(); ?>
                </div>

            </div>
        </div>












