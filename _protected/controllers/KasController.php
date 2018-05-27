<?php

namespace app\controllers;

use Yii;
use app\models\Kas;
use app\models\KasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Saldo;

/**
 * KasController implements the CRUD actions for Kas model.
 */
class KasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionKeluar()
    {
        $model = new Kas();

        $session = Yii::$app->session;
           
        $saldo_id = 0;

        if($session->isActive)
        {
            $username = $session->get('username');    
            $model->penanggung_jawab = $username;
            $saldo_id = $session->get('saldo_id');
        }

        if ($model->load(Yii::$app->request->post())) {

            $saldo = Saldo::find()->where(['id' => $saldo_id])->one();

            if(!empty($saldo))
            {
                $saldo->nilai_akhir -= $model->kas_keluar;
                $saldo->save(false,['nilai_akhir']);


            }

            
            $model->jenis_kas = 0;
            $model->save();
            $tgl = explode('-', $model->tanggal);

            $y = $tgl[0];
            $m = $tgl[1];

            Kas::updateSaldo($m,$y);

            Yii::$app->session->setFlash('success', "Data tersimpan");

            return $this->redirect(['index']);
        }

        $jenis = 0;

        return $this->render('create', [
            'model' => $model,
            'jenis' => $jenis
        ]);
    }

    public function actionMasuk()
    {
        $model = new Kas();

        $session = Yii::$app->session;
           
        if($session->isActive)
        {
            $username = $session->get('username');    
            $model->penanggung_jawab = $username;
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->jenis_kas = 1;            
            $model->save();

            $tgl = explode('-', $model->tanggal);

            $y = $tgl[0];
            $m = $tgl[1];

            Kas::updateSaldo($m,$y);
            Yii::$app->session->setFlash('success', "Data tersimpan");
            return $this->redirect(['/kas/index']);
        }

        $jenis = 1;

        return $this->render('create', [
            'model' => $model,
            'jenis' => $jenis
        ]);
    }

    /**
     * Lists all Kas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KasSearch();
        if(!empty($_POST['bulan']) && !empty($_POST['tahun']))
        {
            $y = $_POST['tahun'];
            $m = $_POST['bulan'];
            $searchModel->start_date = $y.'-'.$m.'-01';
            $searchModel->end_date = $y.'-'.$m.'-'.date('t');
        }



        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Kas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Kas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $jenis = $model->jenis_kas;

        return $this->render('update', [
            'model' => $model,
            'jenis' => $jenis
        ]);
    }

    /**
     * Deletes an existing Kas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
