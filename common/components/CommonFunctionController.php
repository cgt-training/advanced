<?php
	namespace common\components;
    use Yii;

    class CommonFunctionController extends \yii\web\Controller
    {
        public function init(){
            parent::init();
        }

        public function getMaxId($Model_Name='', $Field_Name=''){

            $command = (new \yii\db\Query())
                        ->select(['MAX('.$Field_Name.')+1 as Max_'.$Field_Name])
                        ->from($Model_Name)
                        ->createCommand();

            // returns all rows of the query result
            $rows = $command->queryAll();
            if(isset($rows[0]['Max_'.$Field_Name]) && $rows[0]['Max_'.$Field_Name])
                return $rows[0]['Max_'.$Field_Name];
            else
                return 1;
        }
    }
?>