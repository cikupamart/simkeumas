<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "perkiraan".
 *
 * @property string $kode
 * @property string $nama
 * @property string $parent
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
            [['kode', 'parent'], 'string', 'max' => 20],
            [['nama'], 'string', 'max' => 100],
            [['kode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'nama' => 'Nama',
            'parent' => 'Parent',
        ];
    }
}
