<?php

class Murphy extends Controller {

    function __construct() {
        
        parent::__construct();
    }

    public function index() {

        $this->_view->js = 'murphy/js/default';
        $this->_view->render('murphy');
    }
    
    public function getSections() {
        
        $this->model('Section')->getAll();
    }
    
    public function getUnits($id) {
        
        $this->model('Unit')->getUnits($id);
    }
    
    public function unit($unitId) {
        
        // get description of the Unit
        $desc = $this->model('Unit')->getDescription($unitId);
        
        if($unitId != 3 
                and $unitId != 10 
                and $unitId != 12
                and $unitId != 14
                ) {
            $desc =  str_replace("\n", "<br />", $desc);
        }
        $desc =  str_replace("#tab#", "<span class='desc_sentence'></span>", $desc);
        

        // get pics of the Unit
        $files = self::getPics($unitId);
        $img_path = PATH . IMG_PATH . $unitId . "/";

        $img_arr = array();
        for ($i = 0; $i < count($files); ++$i) {

            $files[$i] = $img_path . $files[$i];
            
            if ($i + 1 > 2) {
                
                $files[$i] = '<img src="' . $files[$i] . '" style="align: center" />';
            }
            else {
                
                $files[$i] = '<img src="' . $files[$i] .  '" class="img_unit"  />';
            }
            $img_arr[] = "#IMG" . ($i + 1) . "#";
        }

        $desc = str_replace($img_arr, $files, $desc);

        $this->_view->description = $desc;
        $this->_view->unitId = $unitId;
        $this->_view->unitTitle = $this->model('Unit')->getUnitTitle($unitId);

        
        /******  Work with exercise of the Unit */
        $exercises = $this->model('Unit')->getExercises($unitId);
        
        // exercises through loop
        for($i = 0; $i < count($exercises); ++$i) {
            
            // double action !!!
            //$number = "<b>" . $unitId . "." . $this->model('Unit')->getExerciseNumber($exercises[$i]['id']) . "</b>";
            $number = "<b>" . $unitId . "." . $exercises[$i]['number'] . "</b>";
            $exercises[$i]['description'] = str_replace("#num#", $number, $exercises[$i]['description']);
            
            $a_pic = "<img src="  . PATH . IMG_PATH_EX . $unitId . "/" . $exercises[$i]['number'] . "/ex.jpg />";
            //echo $a_pic, ' ', $exercises[$i]['number'];
            $exercises[$i]['description'] = str_replace("#img#", $a_pic, $exercises[$i]['description']);
            
            $exercises[$i]['questions'] = Murphy::array_column($this->model("Unit")->getQuestions($exercises[$i]['id']), 'content');
            $exercises[$i]['ids'] = Murphy::array_column($this->model("Unit")->getQuestions($exercises[$i]['id']), 'id');
            

            for($j = 0; $j < count($exercises[$i]['questions']); ++$j) {

                // replace macros to something
                //echo $exercises[$i]['questions'][$j];
                //echo EX_PIC_PATH . " | " . $unitId . " | " . $exercises[$i]['number'] . " | " . ($j + 1);
                $ex_pic = "ex_" . $unitId . "_" . $exercises[$i]['number'] . "_" . ($j + 1) . ".jpg";
                $ex_pic = "<img src="  . EX_PIC_PATH . $ex_pic ." />";
                $exercises[$i]['questions'][$j] = str_replace("#IMG#", $ex_pic, $exercises[$i]['questions'][$j]) ;
                
                $questionId = $exercises[$i]['ids'][$j];
                $textBoxes = $this->model("Unit")->getTextBoxes($questionId);

                // textBoxes through loop
                for($b = 0; $b < count($textBoxes); ++$b) {
                    
                    $length = $this->model('Unit')->getAnswerMaxLength($textBoxes[$b]['id']);
                    $exercises[$i]['questions'][$j] = 
                            str_replace("#tbx".($b + 1)."#", 
                                        "<input type='text' class='input_question' id='".$textBoxes[$b]['id']."' style='width: ".($length * FONT_INPUT)."px' />", 
                                        $exercises[$i]['questions'][$j]);
                }
            }
            
            if($exercises[$i]['constuct'] != null) {
                
                echo "exercises->construct() not implement yet<br />";
            }
            
        }
        
        $this->_view->exercises = $exercises;
        
        $this->_view->js = 'murphy_unit/js/default';
        $this->_view->render('murphy_unit');
    }

    public function dashboard($unitId) {
        
        //echo $unitNumber;
        $this->_view->unitId = $unitId;
        $this->_view->js = 'murphy_dashboard/js/default';
        $this->_view->unitTitle = $this->model('Unit')->getUnitTitle($unitId);
        $desc = $this->model('Unit')->getDescription($unitId);
        
//        $desc =  str_replace("\n", "<br />", $desc);
//        $desc =  str_replace("#tab#", "<span class='desc_sentence'></span>", $desc);
        $this->_view->description = $desc;
        
        $this->_view->render('murphy_dashboard');
    }

    public function descriptionSave($unitId) {

        $content = $_POST['content'];
        //echo $content, " ", $unitId;
        if($this->isDescriptionExists($unitId)) {

            $this->model('Unit')->updateDescription($unitId, $content);
            //echo "True";
        }
        else {
            
            echo "False";
        }
    }


    private function isDescriptionExists($unitId) {
        
        return $this->model('Unit')->isDescriptionExists($unitId);
    }
    
    
    // function for scanning the pics in a proper folder    
    private static function getPics($unitNumber) {
        
        $path = IMG_PATH . $unitNumber . "/";

        if(file_exists($path)) {
        
            $files = scandir($path);
            $files = array_values(array_diff($files, array('.', '..'))); // array_values: reset indexes after unset

            return $files;
        }
        else {
            
            return false;
        }
    }
    
    public function getAnswers($unitId) {
        
        $this->model('Unit')->getAswers($unitId);
    }
	
	static function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( ! isset($value[$columnKey])) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( ! isset($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
}
