<?php

use app\widgets\Messenger;
$this->title = 'Мессенджер';

?>
<div class="register-dog-page">
    <div class="" style="position: relative;
z-index: 1;
background: #FFFFFF;
min-width: 360px;
max-width: 95%;
margin: 0 auto 100px;
padding: 45px;
text-align: center;
box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);">
        <?= Messenger::widget() ?>
    </div>
</div>
