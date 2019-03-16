<?php

use app\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin();  ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'title'), ['prompt' => 'Оберіть категорію..']) ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <label> <?= $model->getAttributeLabel('image') ?> </label>
        </div>
        <div class="panel-body">
            <?= ($model->image)? '<img src="'.$model->getImage().'" class="img-thumbnail">' : "no image uploaded" ?>
        </div>
        <div class="panel-footer">
            <?= $form->field($model, 'image')->fileInput()->label(false) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
