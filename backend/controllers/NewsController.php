<?php
namespace app\controllers;

use yii\rest\ActiveController;

/**
 * NewsController implements the CRUD actions for News model.
 */
/**
 * Класс конроллера NewsController.
 *
 * Включает в себя действия для модели News.
 *
 * @author A. Plotnikov <ua3p@mail.ru>
 */
class NewsController extends ActiveController
{
    /**
     * Класс привязанной модели
     *
     * @var string
     */
    public $modelClass = 'app\models\News';

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    /**
     * @return \yii\data\ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        $searchModel = new \app\models\NewsSearch();
        return $searchModel->search(\Yii::$app->request->queryParams);
    }
}
