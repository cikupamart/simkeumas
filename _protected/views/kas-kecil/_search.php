<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KasKecilSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kas-kecil-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kwitansi') ?>

    <?= $form->field($model, 'penanggung_jawab') ?>

    <?= $form->field($model, 'perkiraan_id') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'tanggal') ?>

    <?php // echo $form->field($model, 'jenis_kas') ?>

    <?php // echo $form->field($model, 'kas_keluar') ?>

    <?php // echo $form->field($model, 'kas_masuk') ?>

    <?php // echo $form->field($model, 'created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
