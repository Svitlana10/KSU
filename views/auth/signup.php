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
                        <div class="form-group">
                            <?= Html::submitButton('Зареєструватись', ['class' => 'button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>









