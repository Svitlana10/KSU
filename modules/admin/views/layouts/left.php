<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
<!--        <div class="user-panel">-->
<!--            <div class="pull-left image">-->
<!--                <img src="--><?//= $directoryAsset ?><!--/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>-->
<!--            </div>-->
<!--            <div class="pull-left info">-->
<!--                <p>Alexander Pierce</p>-->
<!--            </div>-->
<!--        </div>-->

        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--            </div>-->
<!--        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Новини', 'icon' => 'file-code-o', 'url' => ['/admin/article']],
                    ['label' => 'Категорії', 'icon' => 'file-code-o', 'url' => ['/admin/category']],
                    ['label' => 'Коментарі', 'icon' => 'file-code-o', 'url' => ['/admin/comment']],
                    [
                        'label' => 'Собаки',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Усі собаки', 'icon' => 'file-code-o', 'url' => ['/admin/dog']],
                            ['label' => 'Породи', 'icon' => 'file-code-o', 'url' => ['/admin/dog-breeds']],
                            ['label' => 'Усі шоу', 'icon' => 'file-code-o', 'url' => ['/admin/dog-show']],
                            ['label' => 'Типи', 'icon' => 'file-code-o', 'url' => ['/admin/dog-types']],
                        ],
                    ],
                    ['label' => 'Усі шоу', 'icon' => 'file-code-o', 'url' => ['/admin/show']],
//                    ['label' => 'Доки', 'icon' => 'file-code-o', 'url' => ['/admin/default']],
                    ['label' => 'Теги', 'icon' => 'file-code-o', 'url' => ['/admin/tag']],
                ],
            ]
        ) ?>

    </section>

</aside>
