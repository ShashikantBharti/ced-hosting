<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

class Database
{
    private $_host;
    private $_user;
    private $_password;
    private $_dbname;

    
    protected function connect()
    {
        $this->_host = 'localhost';
        $this->_user = 'root';
        $this->_password = '';
        $this->_dbname = 'cedhosting';

        return (new mysqli($this->_host, $this->_user, $this->_password, $this->_dbname));
    }
}

class Query extends Database
{

    public function getData($table, $fields = '', $conditions = '')
    {
        $sql = "SELECT * FROM `$table`";
        if ($fields != '') {
            $fields = "`".implode('`,`', $fields)."`";
            $sql = "SELECT $fields FROM `$table`";
        }
        if ($conditions != '') {
            $sql .= " WHERE ";
            $c = count($conditions);
            $i = 1;
            foreach ($conditions as $key => $value) {
                if ($c == $i) {
                    $sql .= " `$key` = '$value'";
                } else {
                    $sql .= " `$key` = '$value' AND";
                }
                $i++;
            }
        }
        
        $result = $this->connect()->query($sql);
        if ($result -> num_rows > 0) {
            $arr = array();
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
            return $arr;
        }
        return 0;
    }

    // select tbl_product.*,tbl_product_description.* from tbl_product join tbl_product_description where tbl_product.id=tbl_product_description.prod_id
    function getDataFrom($table1 = '',  $table2 = '', $condition = '', $fields1 = '', $fields2 = '') {
        $sql = " SELECT ";
        if ($fields1 != '') {
            $count = count($fields1);
            $i = 1;
            foreach($fields1 as $field) {
                if($count == $i) {
                    $sql .= " `$table1`.`$field` ";
                } else {
                    $sql .= " `$table1`.`$field`, ";
               }
            }
        } else {
            $sql .= " `$table1`.*, ";
        }
        if ($fields2 != '') {
            $sql .= ", ";
            $count = count($fields2);
            $i = 1;
            foreach($fields2 as $field) {
                if($count == $i) {
                    $sql .= " `$table2`.`$field` ";
                } else {
                    $sql .= " `$table2`.`$field`, ";
               }
            }
        } else {
            $sql .= " `$table2`.* ";
        }

        if($condition != '') {
            $sql .= " FROM `$table1` JOIN `$table2` WHERE `$table1`.`$condition[0]` = `$table2`.`$condition[1]` ";
        }
        echo $sql;
    }


    public function insertData($table = '', $data = '')
    {
        if ($data != '') {
            $fields = array();
            $values = array();

            foreach ($data as $key => $value) {
                $fields[] = $key;
                $values[] = $value;
            }

            $fields = "`".implode('`,`', $fields)."`";
            $values = "'".implode("','", $values)."'";
            $sql = "INSERT INTO `$table`($fields) VALUES($values)";
            
            $conn = $this->connect();
            
            if($conn->query($sql) == TRUE){
                return $conn->insert_id;
            } else {
                return 0;
            }
           
        }
    }

    public function updateData($table, $data = '', $conditions = '')
    {
        if ($data != '') {
            $sql = " UPDATE `$table` SET ";
            $c = count($data);
            $i = 1;

            foreach ($data as $key => $value) {
                if ($c == $i) {
                    $sql .= " `$key`='$value'";
                } else {
                    $sql .= " `$key`='$value',";
                }
                $i++;
            }

            foreach ($conditions as $key => $value) {
                $sql .= " WHERE `$key`='$value'";
            }
            
            return $this->connect()->query($sql);
        }
    }

    public function deleteData($table, $conditions = '')
    {
        if ($conditions != '') {
            $sql = "DELETE FROM `$table` WHERE";
            $count = count($conditions);
            $i = 1;

            foreach ($conditions as $key => $value) {
                if ($count == $i) {
                    $sql .= " `$key`='$value' ";
                } else {
                    $sql .= " `$key`='$value' AND";
                }
                $i++;
            }
            return $this->connect()->query($sql);
        }
    }

    public function sendMail($to = '', $name = '', $id = '')
    {
        
        $robo = 'surya.indian321@gmail.com';

        $developmentMode = false;

        $mailer = new PHPMailer($developmentMode);

        try {
            // $mailer->SMTPDebug = 2;
            $mailer->isSMTP();

            if ($developmentMode) {
                    $mailer->SMTPOptions = [
                    'ssl'=> [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                    ]
                    ];
            }


            $mailer->Host = 'smtp.gmail.com';
            $mailer->SMTPAuth = true;
            // Sender Email ID
            $mailer->Username = 'surya.indian321@gmail.com';
            $mailer->Password = base64_decode('U3VyeWFAMjQ3');

            $mailer->SMTPSecure = 'ssl';
            $mailer->Port = 465;

            // Sender
            $mailer->setFrom('surya.indian321@gmail.com', 'Shashikant Bharti');
            // Reciever
            $mailer->addAddress($to, $name);

            $mailer->isHTML(true);
            $id = base64_encode($id);
            $action = base64_encode('email');
            $mailer->Subject = 'Ced Hosting Verification email';
            $mailer->Body = '<h4>Ced Hosting Varification Email</h4>
                             <p>Please click below link to varify your email.</p><br> 
                             <a style="display:inline-block;padding:14px 20px; background:#407294;color:#fff;" href="http://localhost/training/ced_hosting/login.php?varify='.$action.'&id='.$id.'">Varify</a>';

            $mailer->send();
            $mailer->ClearAllRecipients();
            return 1;
        } catch (Exception $e) {
           return 0;
        }
    }

    public function getSafeValue($value = '')
    {
        if($value != '') {
            return $this->connect()->real_escape_string($value);
        } 
        return '';
    }

}
