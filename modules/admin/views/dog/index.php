<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searchs\DogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dog', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Create document', ['document'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'dog_name',
            [
                'label' => 'Порода',
                'value' => function($data){
                    /** @var \app\models\Dog $data */
                    return $data->breed->title;
                }
            ],
            'pedigree_number',
            'owner',
            'months',
            [
                'label' => 'Тип',
                'value' => function($data){
                    /** @var \app\models\Dog $data*/
                    return $data->type->title;
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
