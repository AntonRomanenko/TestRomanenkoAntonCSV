<?php
require_once "database\Database.php";

    class Data {
        private $file;
        private $filePath;
        private $database;
        function __construct($file) {
            $this->database = new Database('localhost', 'root', 'root', 'csv_db');
          //  var_dump($file);
                if( !$file['name']) {
                    return;
                }
                 $fileFormat = explode('.', $file['name'])[1];
                //валидация
               // var_dump($fileFormat);
               
                if($fileFormat !== "csv") {
                    throw new RuntimeException('Invalid parameters.');
                    die(0);
                }
    
               $this->file = $file;
     
                
        }

        public function upload() {
            $csv = $this->file;
           //var_dump( $csv);
            if(!is_dir('./csv')) {
                mkdir('./csv', 0777, true);
            }

            $filename = 'my_upload_file' . $csv["name"];

            move_uploaded_file($csv["tmp_name"], "./csv/" . $filename);
            $this->filePath = "./csv/" . $filename;
        }

        public function getDataFromUploadFile() {
            $parceFileData = array_map('str_getcsv', file($this->filePath));
            array_walk($parceFileData, function(&$a) use ($parceFileData) {
            $a = array_combine($parceFileData[0], $a);
            });
            array_shift($parceFileData);
            return $parceFileData;
        }

        public function selectFromDatabase() {
            return $this->database->select('SELECT * FROM users_1');
        }

        public function saveDateToDatabase() {
            $data = $this->getDataFromUploadFile();
            foreach ($data as $item) {
                $querySelect = "SELECT * FROM `users_1` WHERE uid = " . $item['UID'];
                $findRow = $this->database->select($querySelect);
                if(!count($findRow)) {
                    $r = implode("','",$item);
                    $queryInsert = "INSERT INTO users_1 (uid, name, age, email, phone, gender)
                    VALUES (" .  "'".$r."'" . ")";
                    $this->database->query($queryInsert);
                }
            }
        }
    }
?>