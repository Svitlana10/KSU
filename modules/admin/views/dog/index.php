<?php

use app\models\Dog;
use app\models\DogBreeds;
use app\models\DogTypes;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searchs\DogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Собаки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати собаку', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Створити документ', ['document'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Створити документу роословних', ['create-document-pedigree'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'dog_name',
            [
                'attribute' => 'breed_id',
                'label' => 'Порода',
                'value' => function ($data) {
                    /** @var Dog $data */
                    return $data->breed->title;
                },
                'filter' => DogBreeds::getBreedsList(),
            ],
            'pedigree_number',
            'owner',
            'months',
            [
                'attribute' => 'type_id',
                'label' => 'Стать',
                'value' => function ($data) {
                    /** @var Dog $data */
                    return $data->type->title;
                },
                'filter' => DogTypes::getBreedsList(),
            ],
            [
                'attribute' => 'status',
                'format' => 'text',
                'content' => function ($data) {
                    /** @var Dog $data */
                    return $data->statusTitle;
                },
                'filter' => Dog::getStatusList(),
            ],
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
