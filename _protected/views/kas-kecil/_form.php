<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KasKecil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kas-kecil-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kwitansi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'penanggung_jawab')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'perkiraan_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <?= $form->field($model, 'jenis_kas')->textInput() ?>

    <?= $form->field($model, 'kas_keluar')->textInput() ?>

    <?= $form->field($model, 'kas_masuk')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
