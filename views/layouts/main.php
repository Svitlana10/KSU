<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\PublicAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

PublicAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body id="backgr">
<?php $this->beginBody() ?>

<nav class="navbar main-menu navbar-default">
    <div class="container">
        <div class="menu-content">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" style="width:10%">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/" style="width:100%"><img src="/public/images/logo.png" style="width:100%" alt=""></a>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav text-uppercase">
                    <li><a data-toggle="dropdown" class="dropdown-toggle" href="/">На домашню</a></li>
                    
                    <?php if(!Yii::$app->user->isGuest):?>
                    
                            <li><a href="<?= Url::toRoute(['/admin/default/index'])?>">Адміністрування</a></li>
                            
                        <?php endif;?>
                </ul>
                <div class="i_con">
                    <ul class="nav navbar-nav text-uppercase">
						
                        <?php if(Yii::$app->user->isGuest):?>
                            <li><a href="<?= Url::toRoute(['auth/login'])?>">Авторизуватися</a></li>
                            <li><a href="<?= Url::toRoute(['auth/signup'])?>">Зареєструватися</a></li>
                        <?php else: ?>
                            <?= Html::beginForm(['/auth/logout'], 'post')
                            . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->name . ')',
                                ['class' => 'btn btn-link logout', 'style'=>"padding-top:10px;"]
                            )
                            . Html::endForm() ?>
                            <!-- *********  Header  ********** -->
    
    <div id="header">
        <div id="header_in">
        
        <h1><a href="index.html"><b>NINA</b> THEME</a></h1>
        
        <div id="menu_1">
         <ul>
            <li><a href="index.html" class="active">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="ourwork.html">Our work</a></li>
            <li><a href="blog.html">Blog</a></li>
            <li><a href="contact.html">Contact</a></li>            
         </ul>
        </div>
        
        </div>
    </div>
    
    <!-- *********  Main part (slider)  ********** -->
    
        
        <div id="main_part">
            <div id="main_part_in">
        
            <h2>Free minimalistic HTML template</h2>
            
            <p>That’s right, this template is absolutely for free for any personal or commercial project</p>
            
            </div>
            
            
            <div class="button_main">
                <div class="pxline"></div>
                <a href="download.html" class="button_dark">DOWNLOAD</a>
            </div>
            
        </div>
                        <?php endif;?>
                    </ul>
                </div>

            </div>
            <!-- /.navbar-collapse -->
        </div>
    </div>
    <!-- /.container-fluid -->
</nav>


<?= $content ?>


<footer class="footer-widget-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <aside class="footer-widget">
<!--                    <div class="about-img"><img src="images/logo.png" alt=""></div>-->
                    
                </aside>
            </div>
		<div class="col-md-6">
			 <div class="about-content">Блог створено для лабораторної роботи. Всі права захищені.
                    </div>
                    <div class="address">
                        <h4 class="text-uppercase">Контактна іфнормація</h4>

                        <p> Andrewkolos520@gmail.com</p>

                        <p> 0982343452</p>


                    </div>
			 </div> 
            
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
