<?php
namespace app\controllers;

use app\models\NewsSearch;
use Yii;
use yii\data\ActiveDataProvider;
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
     * @return ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        $searchModel = new NewsSearch();
        return $searchModel->search();
    }
}
