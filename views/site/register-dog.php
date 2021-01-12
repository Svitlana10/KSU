<?php

use app\models\Dog;
use app\models\forms\RegisterForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/** @var $model RegisterForm */
$this->title = "Реєстрація на ". $model->dog->show->title;
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
            <div class="step">
                <h3> Реєстрація собаки </h3>
                <?= $form->field($model->dog, 'dog_name')->textInput(['autofocus' => true])->label('Кличка') ?>
                <?= $form->field($model->dog, 'pedigree_number')->textInput()->label('# родословної') ?>
                <?= $form->field($model->dog, 'owner')->textInput()->label('Хазяїн') ?>
                <?= $form->field($model->dog, 'months')->textInput(["type" => 'number'])->label('Вік (в місяцях)') ?>
                <?= $form->field($model->dog, 'breed_title')->textInput()->label('Порода') ?>
                <?= $form->field($model->dog, 'type_id')->dropDownList(Dog::getAllTypes())->label('Стать') ?>
                <?= $form->field($model->dog, 'email')->textInput()->label('Почтова скринька') ?>
            </div>
            <div class="step">
                <h3> Оплата </h3>
                <?= $form->field($model, 'clientid')->textInput()->label('ІФП') ?>

                <?= $form->field($model->dog, 'payImage')->fileInput()->label('Скрін платіжки') ?>
            </div>
            <p class="talign">
                <a href="#" class="back">Назад</a>
                <a href="#" class="next">Следующий шаг</a>
                <?= Html::submitInput('Зареєструватися', ['class' => 'btn btn-primary', 'name' => 'register-dog--button']) ?>
            </p>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<script>
</script>

