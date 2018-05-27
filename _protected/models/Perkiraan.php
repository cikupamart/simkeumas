<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "perkiraan".
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 * @property string $parent
 * @property int $perusahaan_id
 *
 * @property Perusahaan $perusahaan
 */
class Perkiraan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perkiraan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'nama', 'parent'], 'required'],
            [['perusahaan_id'], 'integer'],
            [['kode', 'parent'], 'string', 'max' => 20],
            [['nama'], 'string', 'max' => 100],
            [['perusahaan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Perusahaan::className(), 'targetAttribute' => ['perusahaan_id' => 'id_perusahaan']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'nama' => 'Nama',
            'parent' => 'Parent',
            'perusahaan_id' => 'Perusahaan ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerusahaan()
    {
        return $this->hasOne(Perusahaan::className(), ['id_perusahaan' => 'perusahaan_id']);
    }
}
