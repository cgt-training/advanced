<?php

namespace frontend\models;

use Yii;

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
            [['c_id', 'c_name', 'c_email', 'c_add', 'c_start_date', 'c_create_date', 'c_status'], 'required'],
            [['c_id'], 'integer'],
            [['c_add', 'c_status'], 'string'],
            [['c_start_date', 'c_create_date'], 'safe'],
            [['c_name'], 'string', 'max' => 100],
            [['c_email'], 'string', 'max' => 150],
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
}
