<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\forms\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <section>
        <div id="container_demo" >
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>
            <div id="wrapper">


                    <form  action="mysuperscript.php" autocomplete="on">
                        <h1> Реєстрація </h1>
                        <?php $form = ActiveForm::begin([
                            'id' => 'signup-form',
                            'layout' => 'horizontal',
                            'fieldConfig' => [
                                'template' => "{label}\n<div class=\"text\">{input}</div>\n<div class=\"password\">{error}</div>",
                                'labelOptions' => ['class' => 'col-lg-1 control-label'],
                            ],
                        ]); ?>
                        <p>
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        </p>
                        <p>
                            <?= $form->field($model, 'email')->textInput() ?>

                        </p>
                        <p>
                            <?= $form->field($model, 'password')->passwordInput() ?>

                        </p>
                        <p>
                            <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Подтвердите ваш пароль </label>
                            <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="123456"/>
                        </p> <p>
                        <div class="form-group">
                            <?= Html::submitButton('Зареєструватись', ['class' => 'button']) ?>
                        </div>
                        </p>

                        <?php ActiveForm::end(); ?>
                    </form>
                </div>
            </div>
        </div>









