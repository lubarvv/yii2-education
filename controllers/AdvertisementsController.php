<?php

namespace app\controllers;

use app\models\Advertisement;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AdvertisementsController extends Controller
{
    public function actionIndex()
    {
        $ads = Advertisement::find()->all();

        return $this->render('list', ['ads' => $ads]);
    }

    /**
     * @param $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $ad = Advertisement::findOne($id);
        if ($ad === null) {
            throw new NotFoundHttpException('This ad does not exists');
        }

        return $this->render('view', ['ad' => $ad]);
    }

    public function actionCreate()
    {
        $ad = new Advertisement();

        if ($ad->load(\Yii::$app->request->post()) && $ad->validate()) {
            $ad->save();

            return $this->redirect(['advertisements/index']);
        }

        return $this->render('create', ['ad' => $ad]);
    }

    public function actionUpdate($id)
    {
        $ad = Advertisement::findOne($id);
        if ($ad === null) {
            throw new NotFoundHttpException('This ad does not exists');
        }

        if ($ad->load(\Yii::$app->request->post()) && $ad->validate()) {
            $ad->save();

            return $this->redirect(['advertisements/index']);
        }

        return $this->render('create', ['ad' => $ad]);
    }
}
