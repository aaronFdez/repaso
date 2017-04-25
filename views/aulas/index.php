<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AulaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$urlAl= "http://www.iesdonana.org/wp-content/uploads/amazingslider/1/images/slide4.jpg";
$opciones = ['width'=>'1140px', 'title' => 'Pasillo de las aulas', 'margin' => 'auto' , 'height'=>'auto'];
$this->title = 'Aulas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aula-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Aula', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'den_aula',
                        'value' => function ($model, $widget) {
                            return Html::a(
                                Html::encode($model->den_aula),
                                ['aulas/view', 'id' => $model->id]
                            );
                        },
                        'format' => 'html',
                    ],
                ],
            ]); ?>

    <?= Html::img($urlAl, $opciones) ?>
