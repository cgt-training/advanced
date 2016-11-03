<?php

namespace common\models;
//namespace backend\base;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "company".
 *
 * @property integer $c_id
 * @property string $c_name
 * @property string $c_email
 * @property string $c_add
 * @property string $c_start_date
 * @property string $c_create_date
 * @property string $c_status
 *
 * @property Branches[] $branches
 * @property Department[] $departments
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $company_count;

    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id', 'c_name', 'c_email', 'c_add' /*'c_start_date', 'c_create_date'*/ , 'c_status'], 'required'],
            ['c_name', 'unique', 'message' => 'This company name has already been taken.'],
            [['c_id'], 'integer'],
            [['c_add', 'c_status'], 'string'],
            [['c_name'], 'string', 'max' => 100],
            [['c_email'], 'string', 'max' => 150],
            // the email attribute should be a valid email address
            ['c_email', 'email','message'=>"The email isn't correct"],
            ['c_email', 'unique','message'=>"Email already exists "],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_id' => 'ID',
            'c_name' => 'Company Name',
            'c_email' => 'Email',
            'c_add' => 'Address',
            'c_start_date' => 'Start Date',
            'c_create_date' => 'Create Date',
            'c_status' => 'Status',
            'c_logo' => 'Compnay Logo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranches()
    {
        return $this->hasMany(Branches::className(), ['c_id' => 'c_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['c_id' => 'c_id']);
    }

    /**
     * @inheritdoc
     * @return CompanyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanyQuery(get_called_class());
    }

    public static function createMultiple($modelClass, $multipleModels = [])
    {
        $model    = new $modelClass;
        $formName = $model->formName();
        $post     = Yii::$app->request->post($formName);
        $models   = [];

        if (! empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'b_id', 'b_id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['b_id']) && !empty($item['b_id']) && isset($multipleModels[$item['b_id']])) {
                    $models[] = $multipleModels[$item['b_id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }
}
