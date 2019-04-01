<?php

use app\models\Dog;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dog_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'breed_title')->textInput(['value' => $model->breedTitle]) ?>

    <?= $form->field($model, 'pedigree_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'owner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'months')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'type_id')->dropDownList(Dog::getAllTypes()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
