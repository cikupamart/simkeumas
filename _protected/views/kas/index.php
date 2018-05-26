<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

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
        <?php 
        if (Yii::$app->user->can('admin')){
            echo Html::a('Create Kas', ['create'], ['class' => 'btn btn-success']); 
        }
        ?>
    </p>
    <?php 

$form = ActiveForm::begin();
    $bulans = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];

    $tahuns = [];

    for($i = 2016 ;$i<=date('Y')+50;$i++)
        $tahuns[$i] = $i;

    ?>

    <div class="col-xs-2">
        
        <?= Html::dropDownList('bulan', !empty($_POST['bulan']) ? $_POST['bulan'] : date('m'),$bulans,['class'=>'form-control ']); ?>

    </div>
     <div class="col-xs-2">
        
       
        <?= Html::dropDownList('tahun', !empty($_POST['tahun']) ? $_POST['tahun'] : date('Y'),$tahuns,['class'=>'form-control ']); ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>
    <?php 
    ActiveForm::end();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'kwitansi',
            'penanggung_jawab',
            'keterangan:ntext',
            'tanggal',
            //'jenis_kas',
            'kas_keluar',
            'kas_masuk',
            //'created',

            ['class' => 'yii\grid\ActionColumn','visible'=>Yii::$app->user->can('admin')],
        ],
    ]); ?>
</div>
