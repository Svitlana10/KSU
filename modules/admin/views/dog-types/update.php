<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DogTypes */

$this->title = 'Update Dog Types: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Dog Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dog-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
