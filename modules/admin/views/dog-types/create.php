<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DogTypes */

$this->title = 'Create Dog Types';
$this->params['breadcrumbs'][] = ['label' => 'Dog Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dog-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
