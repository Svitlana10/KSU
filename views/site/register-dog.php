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
                <?= $form->field($model, 'dog_name')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'pedigree_number')->textInput() ?>
                <?= $form->field($model, 'owner')->textInput() ?>
                <?= $form->field($model, 'months')->textInput(["type" => 'number']) ?>
                <?= $form->field($model, 'breed_title')->textInput() ?>
                <?= $form->field($model, 'type_id')->dropDownList(Dog::getAllTypes()) ?>
                <?= $form->field($model, 'email')->textInput() ?>
            </div>
            <div class="step">
                <?= $form->field($model, 'clientid')->textInput() ?>
                <?= $form->field($model, 'optional_phone')->textInput() ?>
            </div>
            <p class="talign">
                <a href="#" class="back">Назад</a>
                <a href="#" class="next">Следующий шаг</a>
                <?= Html::submitButton('Зареєструватися', ['class' => 'btn btn-primary', 'name' => 'register-dog--button']) ?>
            </p>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<script>
    $(document).ready(function() { // Ждём загрузки страницы

        var steps = $("form").children(".step"); // находим все шаги формы
        $(steps[0]).show(); // показываем первый шаг
        var current_step = 0; // задаем текущий шаг

        $("a.next").click(function(){    // Событие клика на ссылку "Следующий шаг"
            if (current_step === steps.length-2) { // проверяем, будет ли следующий шаг последним
                $(this).hide(); // скрываем ссылку "Следующий шаг"
                $("form input[type=submit]").show(); // показываем кнопку "Регистрация"
            }
            $("a.back").show(); // показываем ссылку "Назад"
            current_step++; // увеличиваем счетчик текущего слайда
            changeStep(current_step); // меняем шаг
        });

        $("a.back").click(function(){    // Событие клика на маленькое изображение
            if (current_step === 1) { // проверяем, будет ли предыдущий шаг первым
                $(this).hide(); // скрываем ссылку "Назад"
            }
            $("form input[type=submit]").hide(); // скрываем кнопку "Регистрация"
            $("a.next").show(); // показываем ссылку "Следующий шаг"
            current_step--; // уменьшаем счетчик текущего слайда
            changeStep(current_step);// меняем шаг
        });

        function changeStep(i) { // функция смены шага
            $(steps).hide(); // скрываем все шаги
            $(steps[i]).show(); // показываем текущий
        }
    });
</script>

