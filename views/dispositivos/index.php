<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DispositivoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$opciones = ['width'=>'1140px', 'title' => 'Pasillo de las aulas', 'margin' => 'auto' , 'height'=>'auto'];

$this->title = 'Dispositivos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dispositivo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Añadir Dispositivo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'marca_disp',
                'value' => function ($model, $widget) {
                    return Html::a(
                        Html::encode($model->marca_disp),
                        ['dispositivos/view', 'id' => $model->id]
                    );
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'modelo_disp',
                'value' => function ($model, $widget) {
                    return Html::a(
                        Html::encode($model->modelo_disp),
                        ['dispositivos/view', 'id' => $model->id]
                    );
                },
                'format' => 'html',
            ],
           [
               'attribute' => 'ubicacion',
               'value' => function ($model, $widget) {
                   if ($model->ordenador_id !== null) {
                       return Html::a(
                           Html::encode($model->ubicacion),
                           ['ordenadores/view', 'id' => $model->ordenador_id]
                       );
                   } else {
                       return Html::a(
                           Html::encode($model->ubicacion),
                           ['aulas/view', 'id' => $model->aula_id]
                       );
                   }
               },
               'format' => 'html',
           ],
           ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?= Html::img("http://4.bp.blogspot.com/-oKmCGYBtWQs/UZHNcwTqUYI/AAAAAAAAANE/QWs7nwjvz2M/s1600/abyss_ojos_10241.jpg", $opciones) ?>
</div>
