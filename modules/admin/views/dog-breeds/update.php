<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DogBreeds */

$this->title = 'Update Dog Breeds: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Dog Breeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dog-breeds-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
