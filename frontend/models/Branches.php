<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "branches".
 *
 * @property integer $b_id
 * @property integer $c_id
 * @property string $br_name
 * @property string $br_address
 * @property string $br_created
 * @property string $br_status
 *
 * @property Company $c
 * @property Department[] $departments
 */
class Branches extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branches';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b_id', 'c_id', 'br_name', 'br_address', 'br_created', 'br_status'], 'required'],
            [['b_id', 'c_id'], 'integer'],
            [['br_address', 'br_status'], 'string'],
            [['br_created'], 'safe'],
            [['br_name'], 'string', 'max' => 100],
            [['c_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['c_id' => 'c_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'b_id' => 'ID',
            'c_id' => 'Compnay',
            'br_name' => 'Branch Name',
            'br_address' => 'Address',
            'br_created' => 'Created',
            'br_status' => 'Status',
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
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['b_id' => 'b_id']);
    }

    /**
     * @inheritdoc
     * @return BranchesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BranchesQuery(get_called_class());
    }
}
