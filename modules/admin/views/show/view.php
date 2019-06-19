<?php

use app\models\Dog;
use app\widgets\MapView;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Show */
/* @var $dogs Dog[] */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Shows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="show-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'address',
            'show_date:datetime',
            'img',
            'start_reg_date:datetime',
            'end_reg_date:datetime',
            [
                'label' => 'Створив',
                'value' => $model->user->username
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <?= MapView::widget(['model' => $model]) ?>


    <?php if($dogs) echo "<h1>Собаки:</h1>" ;{ foreach ($dogs as $dog) : ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <label> <?= $dog->dog_name ?> </label> <?= Html::a('Переглянути', ['/admin/dog/view', 'id' => $dog->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Видалити з шоу', ['/admin/dog-show/delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Видалити собаку', ['/admin/dog/delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="panel-body">
                <label>Власник:</label><?= $dog->owner ?><hr>
                <label>№ Родословної:</label><?= $dog->pedigree_number ?><hr>
                <label>Місяців:</label><?= $dog->months ?><hr>
                <label>Пол:</label><?= $dog->type->title ?>
            </div>
        </div>
    <?php endforeach; } ?>

</div>
