<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Пост', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагування', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Змініти фото', ['set-image', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Зміти категорію', ['set-category', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Змінити Тег', ['set-tags', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'content:ntext',
            'image',
            'viewed',
            'user_id',
            'status',
            'category_id',
            'created_at:datetime',
            'updated_at:datetime'
        ],
    ]) ?>

</div>
