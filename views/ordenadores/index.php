<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdenadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ordenadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordenador-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Añadir Ordenador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'marca_ord',
                'value' => function ($model, $widget) {
                    return Html::a(
                        Html::encode($model->marca_ord),
                        ['ordenadores/view', 'id' => $model->id]
                    );
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'modelo_ord',
                'value' => function ($model, $widget) {
                    return Html::a(
                        Html::encode($model->modelo_ord),
                        ['ordenadores/view', 'id' => $model->id]
                    );
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'aula_id',
                'value' => function ($model, $widget) {
                    return Html::a(
                        Html::encode($model->aula->den_aula),
                        ['aulas/view', 'id' => $model->aula_id]
                    );
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'numero',
                'value' => function ($model, $widget) {
                    return count($model->dispositivos);
                },
                'label' => 'Número de dispositivos',
            ],
            ['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>
</div>
