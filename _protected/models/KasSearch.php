<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kas;

/**
 * KasSearch represents the model behind the search form of `app\models\Kas`.
 */
class KasSearch extends Kas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'jenis_kas'], 'integer'],
            [['kwitansi', 'penanggung_jawab', 'keterangan', 'tanggal', 'created'], 'safe'],
            [['kas_keluar', 'kas_masuk'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Kas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tanggal' => $this->tanggal,
            'jenis_kas' => $this->jenis_kas,
            'kas_keluar' => $this->kas_keluar,
            'kas_masuk' => $this->kas_masuk,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'kwitansi', $this->kwitansi])
            ->andFilterWhere(['like', 'penanggung_jawab', $this->penanggung_jawab])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
