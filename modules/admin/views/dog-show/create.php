<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DogShow */

$this->title = 'Create Dog Show';
$this->params['breadcrumbs'][] = ['label' => 'Dog Shows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dog-show-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
