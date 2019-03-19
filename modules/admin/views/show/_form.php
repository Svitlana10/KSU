<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\forms\ShowForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="show-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'show_date')->widget(DateTimePicker::class, [
            'options' => ['placeholder' => 'Введіть дату/час проведення виставки', 'readonly' => true],
            'removeButton' => false,
            'pluginOptions' => [
                    'autoClose' => true
            ]
    ]) ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <label> <?= $model->getAttributeLabel('img') ?> </label>
        </div>
        <div class="panel-body">
            <?= ($model->img)? '<img src="'.$model->image.'" class="img-thumbnail">' : "no image uploaded" ?>
        </div>
        <div class="panel-footer">
            <?= $form->field($model, 'img')->fileInput()->label(false) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Реєстрація</div>
        <div class="panel-body">
            <div class="col-mod-6">
                <?= $form->field($model, 'start_reg_date')->widget(DateTimePicker::class, [
                    'options' => ['placeholder' => 'Введіть дату/час початку реєстрації', 'readonly' => true],
                    'removeButton' => false,
                    'pluginOptions' => [
                        'autoClose' => true
                    ]
                ]) ?>
            </div>
            <div class="col-mod-6">
                <?= $form->field($model, 'end_reg_date')->widget(DateTimePicker::class, [
                    'options' => ['placeholder' => 'Введіть дату/час закінчення рєстрації', 'readonly' => true],
                    'removeButton' => false,
                    'pluginOptions' => [
                        'autoClose' => true
                    ]
                ]) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->show->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $model->show->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>