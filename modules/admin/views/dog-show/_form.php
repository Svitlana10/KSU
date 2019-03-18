<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\forms\DogShowForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dog-show-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'show_date')->textInput() ?>

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

    <?= $form->field($model, 'start_reg_date')->textInput() ?>

    <?= $form->field($model, 'end_reg_date')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->dog_show->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $model->dog_show->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
