<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $cust_id
 * @property string $cust_name
 * @property integer $zip_code
 * @property string $city
 * @property string $province
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cust_id', 'cust_name', 'zip_code', 'city', 'province'], 'required'],
            [['cust_id', 'zip_code'], 'integer'],
            [['cust_name', 'province'], 'string', 'max' => 150],
            [['city'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cust_id' => 'Cust ID',
            'cust_name' => 'Cust Name',
            'zip_code' => 'Zip Code',
            'city' => 'City',
            'province' => 'Province',
        ];
    }
}
