<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kas".
 *
 * @property int $id
 * @property string $kwitansi
 * @property string $penanggung_jawab
 * @property string $keterangan
 * @property string $tanggal
 * @property int $jenis_kas
 * @property double $kas_keluar
 * @property double $kas_masuk
 * @property string $created
 */
class Kas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kwitansi', 'penanggung_jawab', 'keterangan', 'tanggal'], 'required'],
            [['keterangan'], 'string'],
            [['tanggal', 'created'], 'safe'],
            [['jenis_kas'], 'integer'],
            [['kas_keluar', 'kas_masuk'], 'number'],
            [['kwitansi'], 'string', 'max' => 50],
            [['penanggung_jawab'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kwitansi' => 'Kwitansi',
            'penanggung_jawab' => 'Penanggung Jawab',
            'keterangan' => 'Keterangan',
            'tanggal' => 'Tanggal',
            'jenis_kas' => 'Jenis Kas',
            'kas_keluar' => 'Kas Keluar',
            'kas_masuk' => 'Kas Masuk',
            'created' => 'Created',
        ];
    }

    public static function getTotal($provider, $columnName)
    {
        $total = 0;
        foreach ($provider as $item) {
          $total += $item[$columnName];
      }
      return $total;  
    }
}
