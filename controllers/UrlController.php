<?php

namespace app\controllers;

use app\components\YiiUrlMaker;
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
        }

        return $this->render('create', ['model' => $model,]);
    }

    /**
     * Displays a single Url model.
     * @param string $short
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($short)
    {
        $model = Url::findOne(['short' => $short]);
        if (is_null($model)) {
            throw new NotFoundHttpException('URL not found');
        }
        return $this->render('view', [
            'url' => $model->url,
            'short' => (new YiiUrlMaker($model))->getAbsoluteUrl(),
        ]);
    }

    /**
     * @param $short
     * @return \yii\web\Response
     */
    public function actionRedirect($short)
    {
        $model = Url::findOne(['short' => $short]);
        if (is_null($model)) {
            return $this->redirect(['view', 'short' => $short]);
        }

        Yii::$app->response->headers->set('Cache-Control', ['private', 'no-cache']);

        // http status code 302 Found - to catch all views without cache
        return $this->redirect($model->url, 302);
    }
}
