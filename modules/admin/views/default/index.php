<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;



$this->title = 'Документи';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(!empty($comments)):?>
    <?php endif;?>
    <div>
        <!--<label>
            <p class="" for="fname">Родословна</p>
        </label>-->

        <label for="fname">Порода собаки</label>
              <input type="text" id="fname" name="firstname" >
        <label for="fname">Власник</label>
              <input type="text" id="fname" name="firstname" >
        <label for="lname">Last Name</label>
              <input type="text" id="lname" name="lastname" >
        <label for="country">Стать собаки</label>
        <select id="country" name="country">
            <option value="australia">Хлопчик</option>
            <option value="canada">Дівчинка</option>
        </select>
        <label for="fname">Дата народження собаки </label>
        <input type="text" id="fname" name="firstname" >

        <input type="submit" value="Сформувати файл">
    </div>

</div>
<style>
    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }



</style>
