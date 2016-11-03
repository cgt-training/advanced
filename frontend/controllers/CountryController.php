<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use common\models\Country;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

class CountryController extends Controller
{
    public function actionIndex()
    {
        $query = Country::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);


        $dataProvider = new ActiveDataProvider([
            'query' => Country::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        echo GridView::widget([
            'dataProvider' => $dataProvider,
        ]);


    }
}