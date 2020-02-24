<?php

/**
 * Description of Add
 *
 * @author piraterCMS
 * */
class App_Add
{

    public static $content;
    // Constructor
    public function __construct()
    {
        Switch (Core_Sections::$module['url'][0]) {
            case 'add' :
                Switch (Core_Sections::$module['url'][1]) {
                    case 'step1' :
                        self::$content = self::addCarStep1();
                        return;
                    case 'step2' :
                        self::$content = self::addCarStep2();
                        return;
                    case 'step3' :
                        self::$content = self::addCarStep3();
                        return;
                }

            case 'list' :
                self::$content = self::listCar();
                return;
            case 'upload-file' :
                self::$content = self::upload_file();
                return;
        }
    }

    public static function addCarStep1(){

        if(isset($_POST['step1'])){
            self::$content = self::addCarStep1Post();
        }

        Core_Layout::assign('brands',Core_Fields::getValuesById(124));
        Core_Layout::assign('colors',Core_Fields::getValuesById(90));
        Core_Layout::assign('fuels',Core_Fields::getValuesById(9));
        Core_Layout::assign('bodies',Core_Fields::getValuesById(2));
        Core_Layout::assign('transmissions',Core_Fields::getValuesById(11));
        Core_Layout::assign('capacities',Core_Fields::getValuesById(5));
        Core_Layout::assign('power',Core_Fields::getValuesById(10));
        return Core_Layout::fetch('app/car.add.form.tpl');
    }

    public static function addCarStep1Post(){
            $user=$_SESSION[User_Auth::SESSION_INDEX];

            $insert = array(
                'partnerId' => $user['id'],
                'brand' => $_POST['brandId'],
                'model' => $_POST['model'],
                'type' => $_POST['type'],
                'vin' => $_POST['vin'],
                'firstRegistration' => $_POST['first_reg'],
                'fuelTypeId' => $_POST['fuel_type'],
                'bodyTypeId' => $_POST['body_type'],
                'transmissionTypeId' => $_POST['transmission'],
                'colorId' => $_POST['color'],
                'mileage' => $_POST['mileage'],
                'capacity' => $_POST['capacity'],
                'power' => $_POST['power'],
                'timeAdd' => Database::now(),
            );
            header("Location: ".$_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".Language::$lang."/avtomobili/add/step2/");
            return Database::insert('app__car_list', $insert);

        }


    public static function addCarStep2(){
        return Core_Layout::fetch('app/car.add.form.step2.tpl');
    }

    public function upload_file(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            print_r($_FILES);die('asas');
        }
    }

    public static function addCarStep3(){
        die('step3');
    }

    public static function listCar(){
        return Core_Layout::fetch('app/car.list.tpl');
    }

}
