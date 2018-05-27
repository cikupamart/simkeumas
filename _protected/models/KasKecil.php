<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kas_kecil".
 *
 * @property int $id
 * @property string $kwitansi
 * @property string $penanggung_jawab
 * @property string $perkiraan_id
 * @property string $keterangan
 * @property string $tanggal
 * @property int $jenis_kas
 * @property double $kas_keluar
 * @property double $kas_masuk
 * @property string $created
 *
 * @property Perkiraan $perkiraan
 */
class KasKecil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kas_kecil';
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'mdm\autonumber\Behavior',
                'attribute' => 'kwitansi', // required
                // 'group' => $this->id_branch, // optional
                'value' => 'KW-KC.'.date('Y-m-d').'.?' , // format auto number. '?' will be replaced with generated number
                'digit' => 4 // optional, default to null. 
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['penanggung_jawab', 'perkiraan_id', 'keterangan', 'tanggal'], 'required'],
            [['keterangan'], 'string'],
            [['kwitansi'], 'autonumber', 'format'=>'KW-KC.'.date('Y-m-d').'.?'],
            [['tanggal', 'created'], 'safe'],
            [['jenis_kas'], 'integer'],
            [['kas_keluar', 'kas_masuk'], 'number'],
            [['kwitansi'], 'string', 'max' => 50],
            [['penanggung_jawab'], 'string', 'max' => 255],
            [['perkiraan_id'], 'string', 'max' => 20],
            [['perkiraan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Perkiraan::className(), 'targetAttribute' => ['perkiraan_id' => 'kode']],
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
            'perkiraan_id' => 'Perkiraan ID',
            'keterangan' => 'Keterangan',
            'tanggal' => 'Tanggal',
            'jenis_kas' => 'Jenis Kas',
            'kas_keluar' => 'Kas Keluar',
            'kas_masuk' => 'Kas Masuk',
             'saldo' => 'Saldo',
            'created' => 'Created',
        ];
    }

    public static function updateSaldo($bulan, $tahun)
    {
        
        
        $y = $tahun;
        $m = $bulan;
        $sd = $y.'-'.$m.'-01';
        $ed = $y.'-'.$m.'-'.date('t');
        
        $kas = KasKecil::find()->where(['between','tanggal',$sd,$ed])->orderBy(['tanggal'=>'ASC'])->all();

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

        else
        {
            $saldo = Saldo::find()->where(['jenis' => 'kecil','bulan'=>$bulan,'tahun'=>$tahun])->one();

            if(!empty($saldo))
            {
                $saldo_awal = $saldo->nilai_awal;
                
            }
        }

        $saldo = $saldo_awal;
        foreach($kas as $k)
        {
            if($k->jenis_kas == 1)
                $saldo = $saldo + $k->kas_masuk;
            else
                $saldo = $saldo - $k->kas_keluar;  
            
            $k->saldo = $saldo;
            $k->save();

        }


    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerkiraan()
    {
        return $this->hasOne(Perkiraan::className(), ['kode' => 'perkiraan_id']);
    }

    public static function getTotal($provider, $columnName)
    {
        $total = 0;
        foreach ($provider as $item) {
          $total += $item[$columnName];
      }
      return number_format($total,2,',','.');  
    }
}
