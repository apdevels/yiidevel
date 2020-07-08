<?php
/**
 * @author A. Plotnikov <ua3p@mail.ru>
 *
 * @package NewsSearch
 */
namespace app\models;

//use yii\base\Model;
use yii\data\ActiveDataProvider;
//use app\models\News;

/**
 * NewsSearch - класс модели news,
 * представляющий форму поиска.
 */
class NewsSearch extends News
{
    /**
     * Имя автора
     *
     * @var string
     */
    public $authorName;

    /**
     * Реитинг автора
     *
     * @var string
     */
    public $authorRating;

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [['id', 'author_id'], 'integer'],
            [['date', 'title', 'description',
              'text', 'authorName',
              'authorRating', 'newsCount'
              ], 'safe'
            ],
        ];
    }


    /**
     * Метод search создаёт экземпляр ActiveDataProvider
     * с используемым поисковым запросом
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = News::find();
        $query->innerJoinWith(['authors']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Варианты фильтрации
        //
        $query->andFilterWhere(['like', 'title', $this->title])->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', Authors::tableName() . '.name', $this->authorName])
            ->andFilterWhere(['like', Authors::tableName() . '.rating', $this->authorRating])
        ;
        $query->orderBy('id');

        return $dataProvider;
    }
}
