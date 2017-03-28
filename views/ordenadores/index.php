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
            'marca_ord',
            'modelo_ord',
            'aula.den_aula',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
