<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$urlAl= "https://scontent-mad1-1.xx.fbcdn.net/v/t31.0-8/17966092_1895925607320701_956901448868259626_o.jpg?oh=9e1e58db69433463a98f4bfef8c32a80&oe=598889AD";
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Instituto Doñana</h1>
        <?= Html::img("$urlAl", ['width'=>'1000px', 'height'=>'700px']) ?>
</div>
