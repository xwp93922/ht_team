<?php

namespace common\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CmsAlbum;

/**
 * CmsAlbumSearch represents the model behind the search form about `common\models\CmsAlbum`.
 */
class CmsAlbumSearch extends CmsAlbum
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'site_id','nav_id', 'count_pic', 'status', 'sort_val', 'created_at', 'updated_at'], 'integer'],
            [['name', 'cover'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = CmsAlbum::find();

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
            'lang_id' => $this->lang_id,
            'site_id' => $this->site_id,
            'count_pic' => $this->count_pic,
            'status' => $this->status,
            'sort_val' => $this->sort_val,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        	'nav_id'=>$this->nav_id	
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'cover', $this->cover]);

        return $dataProvider;
    }
}
