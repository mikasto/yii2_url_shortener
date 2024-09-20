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
     * @return string
     * @throws \yii\db\Exception
     * @throws \yii\web\ServerErrorHttpException
     */
    public function actionCreate()
    {
        $model = new Url();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->prepare() && $model->save()) {
                $this->redirect(['view', 'short' => $model->short]);
            }
            $model->addError('url', 'Ошибка генерации. Попробуйте ещё раз');
        }

        return $this->render('create', ['model' => $model,]);
    }

    /**
     * Displays a single Url model.
     * @param string $short
     * @return string
     */
    public function actionView($short)
    {
        $model = Url::findOne(['short' => $short]);
        if (is_null($model)) {
            $this->redirect(['notFound']);
        }
        return $this->render('view', [
            'url' => $model->url,
            'short' => (new YiiUrlMaker($model))->getAbsoluteUrl(),
        ]);
    }

    /**
     * Redirect by short URL
     * @param $short
     * @return void
     */
    public function actionRedirect($short)
    {
        $model = Url::findOne(['short' => $short]);
        if (is_null($model)) {
            $this->redirect(['view', 'short' => $short]);
        }

        Yii::$app->response->headers->set('Cache-Control', ['private', 'no-cache']);

        // http status code 302 Found - to catch all views without cache
        $this->redirect($model->url, 302);
    }
}
