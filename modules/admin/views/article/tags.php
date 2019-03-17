<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $tags app\models\Tag */

$this->title = 'Додати теги';
$this->params['breadcrumbs'][] = ['label' => 'Пост', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <?= Html::dropDownList('tags', $selectedTags , $tags, ['class'=>'form-control', 'multiple'=>true]) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Додати', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
