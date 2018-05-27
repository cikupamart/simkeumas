<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Saldo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="saldo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nilai_awal')->textInput() ?>

    <?= $form->field($model, 'nilai_akhir')->textInput() ?>

    <?= $form->field($model, 'bulan')->textInput() ?>

    <?= $form->field($model, 'tahun')->textInput() ?>

     <?= $form->field($model, 'jenis')->dropDownList(['besar'=>'besar','kecil'=>'kecil']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
