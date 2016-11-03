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
class AuthItemChild extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'auth_item_child';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Role Name',
        ];
    }

    /**
     * @inheritdoc
     * @return CompanyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthItemChildQuery(get_called_class());
    }

   
}
