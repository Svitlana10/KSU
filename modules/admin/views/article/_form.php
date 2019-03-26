<?php

use app\models\Article;
use app\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\forms\ArticleForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin();  ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList(ArrayHelper::map(Article::$statuses, 'id', 'title'), ['prompt' => 'Оберіть статус..']) ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'title'), ['prompt' => 'Оберіть категорію..']) ?>

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
        <?= Html::submitButton($model->article->isNewRecord ? 'Додати' : 'Редагувати', ['class' => $model->article->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
