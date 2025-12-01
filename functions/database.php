<?php
    class Database {
        // host, username, password, database_name
        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "hms";
        public $db;
     
        public function __construct(){
            // connect to database
            try {
                $dbSettings = [
                 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                 PDO::ATTR_EMULATE_PREPARES => false, // Use real prepared statements
                 PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4", // Proper character set
                ]; 
                $this->db = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", 
                $this->username, $this->password, $dbSettings);
                // echo "Connected successfully";
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        function validateRole($requiredRole, $userID = null) {
           return true;
        }

        // select
        function select($from, $where = "1=1", $params = [],  $select = "*", $method = "fetch"){
            $query = $this->db->prepare("SELECT $select FROM $from WHERE $where");
            $query->execute($params);
            switch($method){
                case 'fetch':
                case 'detail':
                case 'single':
                    return $query->fetch(PDO::FETCH_ASSOC);
                case 'all':
                case 'fetchAll':
                case 'multiple':
                case 'list':
                case 'rows':
                    return $query->fetchAll(PDO::FETCH_ASSOC);
                case 'rowCount':
                case 'count':
                    return $query->rowCount();
                default:
                    return $query->rowCount();
            }
        }
        // insert
        function insert($into, $values) {
            $placeholders = rtrim(str_repeat('?, ', count($values)), ', ');
            // var_dump($values);
            $columns = "";
            $data = [];
            foreach($values as $key => $value){
                $columns .= "$key, ";
                $data[] = $value;
            }
            $columns = rtrim($columns, ', ');
             $query = $this->db->prepare("INSERT INTO $into ($columns) VALUES ($placeholders)");
            return $query->execute($data);
        }
        // update
        function update($what, $values, $where) {
            $data = [];
            $setClause = "";
            foreach($values as $key => $value){
                $setClause .= "$key = ?, ";
                $data[] = $value;
            }
            $setClause = rtrim($setClause, ', ');
            $update = $this->db->prepare("UPDATE $what SET $setClause WHERE $where");
            return $update->execute($data);

        }
        // delete
        function delete($from, $where, $params = []) {
            $query = $this->db->prepare("DELETE FROM $from WHERE $where");
            return $query->execute($params);
        }

        function totaldoctors(){
            $totaldoctor = $this->db->prepare("SELECT COUNT(doctor_id) FROM doctors");
            $totaldoctor->execute();
            }
            

function totalpatients(){
$totalpatients = $this->db->prepare("SELECT COUNT(patient_id) FROM patients");
$totalpatients->execute();
}

function totalpatientsattend(){
    $totalpatientattend = $this->db->prepare("SELECT COUNT(patient_id) FROM patient_documents");
    $totalpatientattend->execute();
}


function get_settings($value = "company_name", $where = "settings",  $who = "all", $type = "meta_for")
    {
        $data = $this->select("$where", "meta_name = ? and meta_for = ?", [htmlspecialchars($value), $who]);
       
        if (!is_array($data)) {
            return "";
        }
        if ($this->isEncrypted($data['meta_value'])) {
            $data['meta_value'] = $this->get_enypt_data($data['meta_value']);
        }
        return ($type == "all") ? $data : $data['meta_value'];
    }


     protected function get_enypt_data($id)
    {
        $data = $this->select("encrypted_data", "ID = ?", [$id]);
        if (!is_array($data)) return false;
        return $this->decryptData($data['meta_value']);
    }

    function isEncrypted($data)
    {
        $explode = explode("-", $data);
        if ($explode[0] == "enyptdata") return true;
        return false;
    }

    protected function enypt_unlink($id)
    {
        if ($this->delete("encrypted_data", "ID = ?", [$id])) return true;
        return false;
    }
    function enypt_and_save_data($data)
    {
        if ($data == null || $data == "") return false;
        $mainData = $data;
        $data = $this->encryptData($data);
        if ($data == false || $data == "") return false;
        $data = [
            "ID" => uniqid("enyptdata-"),
            "meta_value" => $data
        ];
        if ($this->quick_insert("encrypted_data", $data)) {
            $data['data'] = $mainData;
            return $data;
        }
        return false;
    }


    function encryptData($data, $secretKey = null)
    {
        if ($secretKey == null && isset($_ENV['DATA_ENCRYPTION_KEY'])) $secretKey = $_ENV['DATA_ENCRYPTION_KEY'];
        if ($secretKey == null) return false;
        $method = 'AES-256-CBC';
        $ivLength = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($ivLength);
        $encryptedData = openssl_encrypt($data, $method, $secretKey, 0, $iv);
        return base64_encode($iv . $encryptedData);
    }

    function decryptData($encryptedDataWithIv, $secretKey = null)
    {
        if ($secretKey == null && isset($_ENV['DATA_ENCRYPTION_KEY'])) $secretKey = $_ENV['DATA_ENCRYPTION_KEY'];
        if ($secretKey == null) return false;
        $method = 'AES-256-CBC';
        $ivLength = openssl_cipher_iv_length($method);
        $ivWithCiphertext = base64_decode($encryptedDataWithIv);
        $iv = substr($ivWithCiphertext, 0, $ivLength);
        $encryptedData = substr($ivWithCiphertext, $ivLength);

        return openssl_decrypt($encryptedData, $method, $secretKey, 0, $iv);
    }


        // close connection
        function __destruct() {
            $this->db = null;
        }



    }
        ?>