<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$urlOrd = "https://www.fib.upc.edu/retroinformatica/exposicio/micrordinadors/com_8296/mainColumnParagraphs/0/image/CBM8296%20.JPG";
$urlDisp = "https://thumbs.dreamstime.com/thumb_121/1217771.jpg";
$urlAl= "https://scontent-mad1-1.xx.fbcdn.net/v/t31.0-8/17966092_1895925607320701_956901448868259626_o.jpg?oh=9e1e58db69433463a98f4bfef8c32a80&oe=598889AD";
$opciones = ['width'=>'300px', 'height'=>'200px'];
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Instituto Doñana</h1>
        <?= Html::img("http://images.schoolmars.es/school-470x330-web/ies-donana.jpg", ['width'=>'700px', 'height'=>'300px']) ?>
</div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Ordenadores</h2>
                <?= Html::img($urlOrd, $opciones) ?>
                <?= Html::a('Ver ordenadores', ['/ordenadores/index'], ['class'=>'btn btn-primary']) ?>
            </div>
            <div class="col-lg-4">
                <h2>Dispositivos</h2>
                <?= Html::img($urlDisp, $opciones) ?>
                <?= Html::a('Ver dispositivos', ['/dispositivos/index'], ['class'=>'btn btn-primary']) ?>
            </div>
            <div class="col-lg-4">
                <h2>Alumnado</h2>
                <?= Html::img($urlAl, $opciones) ?>
                <?= Html::a('Ver foto', ['site/alumnos'], ['class'=>'btn btn-primary']) ?>
            </div>
        </div>

    </div>
</div>
