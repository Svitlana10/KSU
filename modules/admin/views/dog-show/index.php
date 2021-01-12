<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searchs\DogShowSearch*/
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Собаки на шоу';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dog-show-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dog Show', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'dog_id',
                'label' => 'Dog Name',
                'value' => function ($data) {
                    return $data->dog->dog_name;
                },
                'filter' => \app\models\Dog::getAllDogsNames()
            ],
            [
                'attribute' => 'show_id',
                'label' => 'Show Name',
                'value' => function ($data) {
                    return $data->show->title;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
