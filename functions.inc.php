<?php

session_start();

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
            // echo $sql;
            // die;
            return $this->connect()->query($sql);
        }
    }

    public function sendMail($to = '', $name = '')
    {
        
        $robo = 'surya.indian321@gmail.com';

        $developmentMode = true;

        $mailer = new PHPMailer($developmentMode);

        try {
            $mailer->SMTPDebug = 2;
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
            $mailer->Password = base64_decode($password);

            $mailer->SMTPSecure = 'ssl';
            $mailer->Port = 465;

            // Sender
            $mailer->setFrom('surya.indian321@gmail.com', 'Name of sender');
            // Reciever
            $mailer->addAddress($to, $name);

            $mailer->isHTML(true);
            $mailer->Subject = 'PHPMailer Test';
            $mailer->Body = 'This is a <b>SAMPLE<b> email sent through <b>PHPMailer<b>';

            $mailer->send();
            $mailer->ClearAllRecipients();
            echo "MAIL HAS BEEN SENT SUCCESSFULLY";
        } catch (Exception $e) {
            echo "EMAIL SENDING FAILED. INFO: " . $mailer->ErrorInfo;
        }
    }
}
