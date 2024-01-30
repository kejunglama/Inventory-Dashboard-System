<?php
class User
{
    private $con;

    public function __construct()
    {
        include_once "../database/db.php";
        $db = new Database();

        try {
            $this->con = $db->connect();
        } catch (\Throwable$th) {
            echo $th;
        }
    }

    // Check if Email Exists
    public function emailExists($email)
    {
        $prep_stmt = $this->con->prepare("SELECT id FROM company WHERE email=?");
        $prep_stmt->bind_param('s', $email);
        $prep_stmt->execute() or die($this->con->error);

        $result = $prep_stmt->get_result();

        if (($result->num_rows) > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Check if ID Exists
    public function idExists($id)
    {
        $prep_stmt = $this->con->prepare("SELECT id FROM company WHERE id=?");
        $prep_stmt->bind_param('s', $id);
        $prep_stmt->execute() or die($this->con->error);

        $result = $prep_stmt->get_result();

        if (($result->num_rows) > 0) {
            return true;
        } else {
            return false;
        }
    }

    // User Login
    public function userLogin($email, $password)
    {
        $prep_stmt = $this->con->prepare("SELECT id, name, email, password, status, has_DB  FROM company WHERE email = ?");
        $prep_stmt->bind_param('s', $email);
        $prep_stmt->execute() or die($this->con->error);

        $result = $prep_stmt->get_result();

        if ($result->num_rows < 1) {
            return "NOT_REGISTERED";
        } else {

            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) { // if password matches
                if ($row['status']) {
                    if ($row['has_DB']) {

                        // create Session
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['name'] = $row['name'];

                        // set last_login datetime in Session
                        date_default_timezone_set("Asia/Kathmandu");
                        $last_login = date("Y-m-d H:i:s");
                        $_SESSION['last_login'] = $last_login;

                        // update last_login
                        $prep_stmt = $this->con->prepare("UPDATE company SET last_login = ? WHERE email = ? ");
                        $prep_stmt->bind_param('ss', $last_login, $email);
                        $result = $prep_stmt->execute() or die($this->con->error);

                        if ($result) {
                            return "LOGGED_IN".$row['id'];
                        } else {
                            return "ERROR_OCCURRED_WHILE_LOGGING_IN";
                        }
                    } else {
                        return "NO_DB";
                    }
                } else {
                    return "INACTIVE_ACCOUNT";
                }
            } else {
                return "PASSWORD_NOT_MATCH";
            }

        }

    }

    // Create User Company
    public function createAccount($id, $password, $name, $personnel_name, $email, $contact, $address, $city)
    {
        if ($this->emailExists($email)) {
            return ("EMAIL_EXISTS");
        } else if ($this->idExists($id)) {
            return ("ID_EXISTS");
        } else {
            $date = date("Y-m-d H:i:s");
            $pass_hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 8]);

            $prep_stmt = $this->con->prepare("
                INSERT INTO company(id, password, name, personnel_name, email, contact,
                 address, city, reg_date, last_login, status, has_DB) VALUES (?,?,?,?,?,?,?,?,?,?,'0','0')");

            $prep_stmt->bind_param("ssssssssss", $id, $pass_hash, $name, $personnel_name, $email, $contact, $address, $city, $date, $date);
            $result = $prep_stmt->execute() or die($this->con->error);
            return $result;
            if ($result) {
                echo "Inserted";
                return "SUCCESS";
            } else {
                return "FAILED";
            }
        }
    }

    // Access Code Validation
    public function checkCode($code)
    {
        $prep_stmt = $this->con->prepare("SELECT code FROM access WHERE code = ?");
        $prep_stmt->bind_param('s', $code);
        $prep_stmt->execute() or die($this->con->error);

        $result = $prep_stmt->get_result();

        if (($result->num_rows) > 0) {
            return true;
        } else {
            return false;
        }

    }
}

// $user5 = new User();
// echo $user5->userLogin('kejunglama@gmail.com','kejunglama');

// $user5 = new User();
// echo $user5->createAccount('Murphy12','Murphy','Murphy','Murphy','Murphy123','Murphy','Murphy','Murphy');
