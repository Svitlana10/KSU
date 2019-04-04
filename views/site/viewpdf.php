<?php

/** @var $model Show */

use app\models\Dog;
use app\models\Show;
use yii\widgets\DetailView; ?>

<h1><?= $model->title ?></h1>
<h3>Зареєстровані собаки (оплачені)</h3>
<?php
    /** @var Dog $dog */
    foreach ($model->dogs as $dog):
        if($dog->status === Dog::STATUS_APPROVED) {
            echo DetailView::widget([
                'model' => $dog,
                'attributes' => [
                    'dog_name',
                    'breedTitle',
                    'pedigree_number',
                    'owner',
                    'months',
                    [
                        'label' => 'type',
                        'value' => $dog->type->title,
                    ],
                    [
                         'label' => 'Status',
                        'value' => $dog->statusTitle,
                    ],
                ],
            ]);
        }
?>

<?php endforeach; ?>
