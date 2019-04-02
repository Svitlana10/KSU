<?php

use yii\widgets\ListView;
/** @var $dataProvider \app\models\searchs\ArticleSearch */
?>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'tag' => 'div',
        'class' => 'list-wrapper',
        'id' => 'list-wrapper',
    ],
    'pager' => [
        'firstPageLabel' => 'Перша',
        'lastPageLabel' => 'Остання',
        'nextPageLabel' => 'Наступна',
        'prevPageLabel' => 'Попередня',
        'maxButtonCount' => 5,
    ],
    'layout' => "{items}\n{pager}",
    'itemView' => 'index_item',
]) ?>

<!-- end main content-->
<!--footer start-->
