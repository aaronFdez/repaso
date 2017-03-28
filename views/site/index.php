<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$urlOrd = "https://www.fib.upc.edu/retroinformatica/exposicio/micrordinadors/com_8296/mainColumnParagraphs/0/image/CBM8296%20.JPG";
$urlDisp = "https://thumbs.dreamstime.com/thumb_121/1217771.jpg";
$urlAl= "http://www.abc.es/Media/201212/06/ALUMNOS--644x362.jpg";
$opciones = ['width'=>'300px', 'height'=>'200px'];
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Instituto Doñana</h1>
        <?= Html::img("http://wiki.iesdonana.org/lib/exe/fetch.php/donana.png?cache=&w=900&h=477&tok=b46fd3", ['width'=>'500px', 'height'=>'300px']) ?>
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
            </div>
        </div>

    </div>
</div>
