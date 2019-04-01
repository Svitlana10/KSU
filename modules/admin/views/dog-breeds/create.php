<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DogBreeds */

$this->title = 'Create Dog Breeds';
$this->params['breadcrumbs'][] = ['label' => 'Dog Breeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dog-breeds-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
