<aside class="main-sidebar">
    <section class="sidebar">
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
                            ['label' => 'Собаки на виставках', 'icon' => 'file-code-o', 'url' => ['/admin/dog-show']],
                            ['label' => 'Типи', 'icon' => 'file-code-o', 'url' => ['/admin/dog-types']],
                        ],
                    ],
                    ['label' => 'Виставки', 'icon' => 'file-code-o', 'url' => ['/admin/show']],
//                    ['label' => 'Доки', 'icon' => 'file-code-o', 'url' => ['/admin/default']],
                    ['label' => 'Теги', 'icon' => 'file-code-o', 'url' => ['/admin/tag']],
                ],
            ]
        ) ?>
    </section>
</aside>
