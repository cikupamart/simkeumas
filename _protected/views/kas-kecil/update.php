<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KasKecil */

$this->title = 'Update Kas Kecil: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kas Kecils', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kas-kecil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php 
    switch ($jenis) {
    	case 1:
    		echo $this->render('_masuk', [
		        'model' => $model,
		    ]);
    		break;
    	
    	case 0:
    		echo $this->render('_keluar', [
		        'model' => $model,
		    ]);
    		break;
    }
     

    ?>


</div>
