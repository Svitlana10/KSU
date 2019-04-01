<?php

use app\models\Dog;
use app\models\forms\DogShowForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/** @var $model DogShowForm */
$this->title = "Реєстрація на ". $model->show->title;
?>

<div class="register-dog-page">
    <div class="" style="position: relative;
z-index: 1;
background: #FFFFFF;
min-width: 360px;
max-width: 95%;
margin: 0 auto 100px;
padding: 45px;
text-align: center;
box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Будь ласка заповніть поля для реєстрації собаки:</p>
            <?php $form = ActiveForm::begin([
                'id' => 'register-dog-form',
                'layout' => 'horizontal',
                'fieldConfig' =>
                    [
                    'template' => "{label}\n<div class=\"text\">{input}</div>\n<div class=\"password\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-12 text-left', ],
                    ],
                ]); ?>
            <?= $form->field($model, 'dog_name')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'pedigree_number')->textInput() ?>
            <?= $form->field($model, 'owner')->textInput() ?>
            <?= $form->field($model, 'months')->textInput(["type" => 'number']) ?>
            <?= $form->field($model, 'breed_title')->textInput() ?>
            <?= $form->field($model, 'type_id')->dropDownList(Dog::getAllTypes()) ?>
            <?= $form->field($model, 'email')->textInput() ?>
                <?= Html::submitButton('Зареєструватися', ['class' => 'btn btn-primary', 'name' => 'register-dog--button']) ?>
            <?php ActiveForm::end(); ?>


    </div>
</div>
