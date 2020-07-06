<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\web\Linkable;
use yii\web\Link;
use yii\helpers\Url;

/**
 * Класс модели News
 *
 * @author A. Plotnikov <ua3p@mail.ru>
 *
 * @package News
 */
class News extends ActiveRecord
{

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{news}}';
    }


    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 1000],
            [['author_id'], 'exist',
                            'skipOnError' => true,
                            'targetClass' => Authors::class(),
                            'targetAttribute' => ['author_id' => 'id']
            ],
        ];
    }

    /**
     * Метод fields возвращает разрешённые поля для вывода.
     *
     * @return array
     */
    public function fields()
    {
        return array_merge(parent::fields(),
            [
                'name' => function($model) {
                    return $model->authors->name;
                },
                'rating' => function($model) {
                    return $model->authors->rating;
                },
                'count' => function ($model) {
                    return News::find()
                        ->where(['author_id' => $model->authors->id])
                        ->count();
                }
            ]);
    }

    /**
     * @return array|\Closure[]
     */
/*    public function extraFields()
    {
        return [
            'count' => function() {
                return $this::find()
                    ->groupBy('title')
                    ->having(['title' => 'Заголовок 4'])
                    ->count('id');
            }
        ];
    }*/

    /**
     * Метод getAuthors() возвращает данные автора
     * из таблицы authors по id автора.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasOne(Authors::class, ['id' => 'author_id']);
    }
}
