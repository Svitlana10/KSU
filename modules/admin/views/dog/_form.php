<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dog_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'breed_id')->textInput() ?>

    <?= $form->field($model, 'pedigree_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'owner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'months')->textInput() ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
