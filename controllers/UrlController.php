<?php

namespace app\controllers;

use app\models\Url;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UrlController implements the CRUD actions for Url model.
 */
class UrlController extends Controller
{
    /**
     * Creates a new Url model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Url();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'short' => $model->short]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Url model.
     * @param string $short
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($short)
    {
        $url = $this->findModel($short);
        if (is_null($url)) {
            throw new NotFoundHttpException('URL not found');
        }
        return $this->render('view', [
            'url' => strip_tags($url->url),
            'short' => Yii::$app->urlManager->createAbsoluteUrl(['url/redirect', 'short' => $url->short]),
        ]);
    }

    /**
     * Finds the Url model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $short
     * @return Url the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($short)
    {
        if (($model = Url::findOne(['short' => $short])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionRedirect($short)
    {
        $url = $this->findModel($short);
        if (is_null($url)) {
            throw new NotFoundHttpException('URL not found');
        }
        $this->redirect($url->url);
    }
}
