<?php

/**
 * Create category page.
 * 
 * PHP version 7
 * 
 * @category  Functions.
 * @package   Ced_Hosting
 * @author    Shashikant Bharti <surya.indian321@gmail.com>
 * @copyright 2020 CEDCOSS 
 * @license   CEDCOSS 
 * @version   GIT: <1.0>
 * @link      http://127.0.0.1/training/ced_hosting
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

/**
 * Create category page.
 * 
 * PHP version 7
 * 
 * @category  Admin
 * @package   Ced_Hosting
 * @author    Shashikant Bharti <surya.indian321@gmail.com>
 * @copyright 2020 CEDCOSS 
 * @license   CEDCOSS 
 * @link      http://127.0.0.1/training/ced_hosting
 */

class Database
{
    private $_host;
    private $_user;
    private $_password;
    private $_dbname;

    /**
     * Function to connect with database.
     * 
     * @return connection.
     */
    protected function connect()
    {
        $this->_host = 'localhost';
        $this->_user = 'root';
        $this->_password = '';
        $this->_dbname = 'cedhosting';

        return ( new mysqli(
            $this->_host, $this->_user, $this->_password, $this->_dbname
        ));
    }
}


/**
 * Create category page.
 * 
 * PHP version 7
 * 
 * @category  Admin
 * @package   Ced_Hosting
 * @author    Shashikant Bharti <surya.indian321@gmail.com>
 * @copyright 2020 CEDCOSS 
 * @license   CEDCOSS 
 * @link      http://127.0.0.1/training/ced_hosting
 */

class Query extends Database
{

    /**
     * Function to get data from database.
     * 
     * @param $table      Table Name.
     * @param $fields     Fields.
     * @param $conditions Condition 
     *   
     * @return data.
     */
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

    /**
     * Function to connect with database.
     * 
     * @param $table1     First table name.
     * @param $table2     Second table name.
     * @param $condition1 Join condition. 
     * @param $fields1    Fields from first table.
     * @param $fields2    Fields from second table.
     * @param $condition2 Particular condition.
     * 
     * @return connection.
     */
    function getDataFrom(
        $table1 = '',  $table2 = '', $condition1 = '', 
        $fields1 = '', $fields2 = '', $condition2 = ''
    ) {
        $sql = " SELECT ";
        if ($fields1 != '') {
            $count = count($fields1);
            $i = 1;
            foreach ( $fields1 as $field ) {
                if ($count == $i ) {
                    $sql .= " `$table1`.`$field` ";
                } else {
                    $sql .= " `$table1`.`$field`, ";
                }
                $i++;
            }
        } else {
            $sql .= " `$table1`.* ";
        }
        if ($fields2 != '') {
            $sql .= ", ";
            $count = count($fields2);
            $i = 1;
            foreach ($fields2 as $field) {
                if ($count == $i) {
                    $sql .= " `$table2`.`$field` ";
                } else {
                    $sql .= " `$table2`.`$field`, ";
                }
                $i++;
            }
        } else {
            $sql .= ", `$table2`.* ";
        }

        if ($condition1 != '') {
            $sql .= " FROM `$table1` JOIN `$table2` WHERE 
            `$table1`.`$condition1[0]` = `$table2`.`$condition1[1]` ";
        }

        if ($condition2 != '') {
            $sql .= " AND `$condition2[0]`.`$condition2[1]` = '$condition2[2]' ";
        }
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            $arr = array();
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
            return $arr;
        }
        return 0;

    }

    /**
     * Function to insert data in table.
     * 
     * @param $table Table name in which data is to be inserted.
     * @param $data  Data to insert.
     * 
     * @return bool
     */
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
            
            if ($conn->query($sql) == true) {
                return $conn->insert_id;
            } else {
                return 0;
            }
           
        }
    }

    /**
     * Function to update data in database in any table. 
     * 
     * @param $table      Table which is to be updated.
     * @param $data       Data to update.
     * @param $conditions Condition at which data should be update.
     * 
     * @return bool
     */
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

    /**
     * Function to delete data in database in any table. 
     * 
     * @param $table      Table which is to be updated.
     * @param $conditions Condition at which data should be deleted.
     * 
     * @return bool
     */
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

    /**
     * Function to send email. 
     * 
     * @param $to   Reciever email address.
     * @param $name Reciever name.
     * @param $id   Reciever id.
     * 
     * @return bool
     */
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
            $mailer->setFrom('surya.indian321@gmail.com', 'Ced-Hosting');
            // Reciever
            $mailer->addAddress($to, $name);

            $mailer->isHTML(true);
            $id = base64_encode($id);
            $action = base64_encode('email');
            $mailer->Subject = 'Ced Hosting Verification email';
            $mailer->Body = '<h4>Ced Hosting Varification Email</h4>
            <p>Please click below link to varify your email.</p><br> 
            <a style="display:inline-block;padding:14px 20px; 
            background:#407294;color:#fff;" 
            href="http://localhost/training/ced_hosting/login.php?
            varify='.$action.'&id='.$id.'">Varify</a>';

            $mailer->send();
            $mailer->ClearAllRecipients();
            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Function to get safe value.
     * 
     * @param $value Value to filter.
     * 
     * @return value
     */
    public function getSafeValue($value = '')
    {
        if ($value != '') {
            return $this->connect()->real_escape_string($value);
        } 
        return '';
    }

}


/**
 * Cart to manage product.
 * 
 * PHP version 7
 * 
 * @category  Cart
 * @package   Ced_Hosting
 * @author    Shashikant Bharti <surya.indian321@gmail.com>
 * @copyright 2020 CEDCOSS 
 * @license   CEDCOSS 
 * @link      http://127.0.0.1/training/ced_hosting
 */
class Cart
{

    /**
     * Function to add product in cart.
     * 
     * @return void
     */
    public function __construct() 
    {
        if (!isset($_SESSION['CART'])) {
            $_SESSION['CART'] = array();
        }
    }

    /**
     * Function to add product in cart.
     * 
     * @param $id  Id of product.
     * @param $sku SKU of product.
     * 
     * @return void
     */
    public function addProduct($id = '',$sku = '') 
    {
        if (empty($_SESSION['CART'])) {
            $_SESSION['CART'][$id]['sku'] = $sku;
        } else {
            foreach ($_SESSION['CART'] as $product) {
                if ($id != $product['id']) {
                    $_SESSION['CART'][$id]['sku'] = $sku;
                }
            }
        }
    }

    /**
     * Function to remove product from cart.
     * 
     * @param $id Id of product to remove from cart.
     * 
     * @return void
     */
    public function removeProduct($id = '') 
    {
        if (isset($_SESSION['CART'])) {
            unset($_SESSION['CART'][$id]);
        }
    }

    /**
     * Function to remove product from cart.
     *
     * @return void
     */
    public function emptyCart() 
    {
        unset($_SESSION['CART']);
    }

    /**
     * Function to remove product from cart.
     *
     * @return count
     */
    public function totalProduct() 
    {
        if (isset($_SESSION['CART'])) {
            return count($_SESSION['CART']);
        }
    }
}