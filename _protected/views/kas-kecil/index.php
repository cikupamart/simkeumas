<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use yii\widgets\ActiveForm;

use \kartik\grid\GridView;

use app\models\Saldo;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kas Kecil | '.Yii::$app->params['shortname'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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

    <div class="col-xs-4 col-md-3 col-lg-2">
        
        <?= Html::dropDownList('bulan', !empty($_POST['bulan']) ? $_POST['bulan'] : date('m'),$bulans,['class'=>'form-control ']); ?>

    </div>
     <div class="col-xs-4 col-md-3 col-lg-2">
        
       
        <?= Html::dropDownList('tahun', !empty($_POST['tahun']) ? $_POST['tahun'] : date('Y'),$tahuns,['class'=>'form-control ']); ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>
    <?php 
    ActiveForm::end();

    $saldo_awal = 0;
    $session = Yii::$app->session;
    if($session->isActive)
    {
        $saldo_id_kecil = $session->get('saldo_id_kecil');

        $saldo = Saldo::find()->where(['id' => $saldo_id_kecil])->one();

        if(!empty($saldo))
        {
            $saldo_awal = $saldo->nilai_awal;
            
        }
    }
    ?><div class="grid-view hide-resize">
<div id="w1-container" class="table-responsive kv-grid-container">
    <table class="kv-grid-table table table-bordered table-striped">
        <thead>
<tr>
            <th> </th>
            <th> </th>
            <th> </th>
            <th> </th>
            <th></th>
            <th>Saldo Awal</th>
            <th style="text-align: right;"><?=number_format($saldo_awal,2,',','.');?></th>
        </tr>
<tr>
            <th>Kwitansi</th>
            <th>PJ</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Kas Masuk</th>
            <th>Kas Keluar</th>
            <th>Saldo</th>
        </tr>

</thead>

 <tbody>
            <?php 
            $total_masuk = 0;
            $total_keluar = 0;
            $saldo = $saldo_awal;
            foreach ($dataProvider->models as $model) 
            {

                $total_keluar += $model->kas_keluar;
                $total_masuk += $model->kas_masuk;

                

                if($model->jenis_kas == 1)
                {
                    $saldo = $saldo + $model->kas_masuk;
                }

                else{
                    $saldo = $saldo - $model->kas_keluar;   
                }
                # code...
            
            ?>
            <tr>
            <td><?=$model->kwitansi;?></td>
            <td><?=$model->penanggung_jawab;?></td>
            <td><?=$model->tanggal;?></td>
            <td><?=$model->keterangan;?></td>
            <td style="text-align: right;"><?=number_format($model->kas_masuk,2,',','.');?></td>
            <td style="text-align: right;"><?=number_format($model->kas_keluar,2,',','.');?></td>
            <td style="text-align: right;">
                <?= number_format($saldo,2,',','.');?>
                    
                </td>
            </tr>
            <?php
}
             ?>
        </tbody>
<tfoot>

<tr class="kv-table-footer">
    <td>&nbsp;</td>
    <td><strong>Total</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <th style="text-align: right;"><?=number_format($total_masuk,2,',','.');?></th>
    <th style="text-align: right;"><?=number_format($total_keluar,2,',','.');?></th>
    <th style="text-align: right;"><?=number_format($saldo,2,',','.');?></th>
</tr>

</tfoot>
    </table>
</div>
</div>
</div>
