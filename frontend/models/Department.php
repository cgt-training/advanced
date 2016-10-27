<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property integer $dept_id
 * @property integer $b_id
 * @property string $dept_name
 * @property integer $c_id
 * @property string $dept_created_date
 * @property string $dtep_status
 *
 * @property Company $c
 * @property Branches $b
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dept_id', 'b_id', 'dept_name', 'c_id', 'dept_created_date', 'dtep_status'], 'required'],
            [['dept_id', 'b_id', 'c_id'], 'integer'],
            [['dept_created_date'], 'safe'],
            [['dtep_status'], 'string'],
            [['dept_name'], 'string', 'max' => 100],
            [['c_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['c_id' => 'c_id']],
            [['b_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['b_id' => 'b_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dept_id' => 'ID',
            'b_id' => 'Branch',
            'dept_name' => 'Department Name',
            'c_id' => 'Company Name',
            'dept_created_date' => 'Created Date',
            'dtep_status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC()
    {
        return $this->hasOne(Company::className(), ['c_id' => 'c_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB()
    {
        return $this->hasOne(Branches::className(), ['b_id' => 'b_id']);
    }

    /**
     * @inheritdoc
     * @return DepartmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DepartmentQuery(get_called_class());
    }
}
