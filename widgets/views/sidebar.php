
<?php

use app\models\Article;
use app\models\Show;
use yii\helpers\Url;
$show = Show::getOneRegShow();
?>



        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Найпопулярніші пости</h3>
            <?php
            /** @var Article $popular */
            /** @var Article $article */
            foreach($popular as $article):?>
                <div class="popular-post">
                    <a href="<?= Url::toRoute(['site/view','id'=>$article->id]);?>" class="popular-img"><img src="<?= $article->getImage();?>" alt="">

                        <div class="p-overlay"></div>
                    </a>

                    <div class="p-content">
                        <a href="<?= Url::toRoute(['site/view','id'=>$article->id]);?>" class="text-uppercase"><?= $article->title?></a>
                        <span class="p-date"><?= date("Y-m-d H:i:s", $article->created_at)?></span>

                    </div>
                </div>
            <?php endforeach;?>

        </aside>

        <aside class="widget pos-padding">
            <h3 class="widget-title text-uppercase text-center">Недавні пости</h3>
            <?php
            /** @var Article[] $recent */
            /** @var Article $article */
            foreach($recent as $article):?>
                <div class="thumb-latest-posts">
                    <div class="media">
                        <div class="media-left">
                            <a href="<?= Url::toRoute(['site/view','id'=>$article->id]);?>" class="popular-img"><img src="<?= $article->getImage();?>" alt="">
                                <div class="p-overlay"></div>
                            </a>
                        </div>
                        <div class="p-content">
                            <a href="<?= Url::toRoute(['site/view','id'=>$article->id]);?>" class="text-uppercase"><?= $article->title?></a>
                            <span class="p-date"><?= date("Y-m-d H:i:s", $article->created_at)?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </aside>

        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Категорії</h3>
            <ul>
                <?php
                /** @var \app\models\Category[] $categories */
                /** @var \app\models\Category $category */
                foreach($categories as $category):?>
                    <li>
                        <a href="<?= Url::toRoute(['site/index','category_id'=>$category->id]);?>"><?= $category->title?></a>
                        <span class="post-count pull-right"> (<?= $category->getArticlesCount();?>)</span>
                    </li>
                <?php endforeach;?>

            </ul>
        </aside>
