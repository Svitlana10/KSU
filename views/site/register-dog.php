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

        <div class="program-selection">

            <?php $form = ActiveForm::begin([
                'id' => 'register-dog-form',
                'layout' => 'horizontal',
                'fieldConfig' =>
                    [
                        'template' => "{label}\n<div class=\"text\">{input}</div>\n<div class=\"password\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-12 text-left', ],
                    ],
            ]); ?>

            <ul class="nav nav-tabs">
                <li class="active"><a href="#program-selection-step-1" data-toggle="tab"><span></span><i>I шаг</i></a></li>
                <li><a href="#program-selection-step-2" data-toggle="tab"><span class="step-passed">2</span> <i>II шаг</i></a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade in active" id="program-selection-step-1">
                    <p>Будь ласка заповніть поля для реєстрації собаки:</p>
                    <?= $form->field($model, 'dog_name')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'pedigree_number')->textInput() ?>
                    <?= $form->field($model, 'owner')->textInput() ?>
                    <?= $form->field($model, 'months')->textInput(["type" => 'number']) ?>
                    <?= $form->field($model, 'breed_title')->textInput() ?>
                    <?= $form->field($model, 'type_id')->dropDownList(Dog::getAllTypes()) ?>
                    <?= $form->field($model, 'email')->textInput() ?>
                    <?= Html::submitButton('Зареєструватися', ['class' => 'btn btn-primary', 'name' => 'register-dog--button']) ?>
                    <input value="Далее" class="btn btn-default program-selection__button" type="button" data-href="#program-selection-step-2">
                </div><!-- tab-pane -->
                <div class="tab-pane fade in" id="program-selection-step-2">
                    <?php

                    $client_login = "Иванов Иван";
                    $orderid = "9933413";
                    $order_sum = "1530";
                    $optional_phone = "9183331122";

                    $payment_parameters = http_build_query(array("clientid" => $client_login,
                        "orderid" => $orderid,
                        "sum" => $order_sum,
                        "phone" => $optional_phone));
                    $options = array("http" => array(
                        "method" => "POST",
                        "header" =>
                            "Content-type: application/x-www-form-urlencoded",
                        "content" => $payment_parameters
                    ));
                    $context = stream_context_create($options);

                    echo file_get_contents("http://demo.paykeeper.ru/order/inline/", FALSE, $context);
                    ?>
                    <input value="Назад" class="btn btn-default program-selection__button" type="button" data-href="#program-selection-step-1">
                </div><!-- tab-pane -->
            </div><!-- tab-content -->

            <?php ActiveForm::end(); ?>

        </div><!-- program-selection -->
    </div>
</div>

