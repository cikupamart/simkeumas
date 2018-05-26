<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Kas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'kwitansi',
            'penanggung_jawab',
            'keterangan:ntext',
            'tanggal',
            //'jenis_kas',
            //'kas_keluar',
            //'kas_masuk',
            //'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
