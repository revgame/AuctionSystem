<?php
require_once ('Models/Database.php');

class User
{
    //Fields
    protected $_dbInstance, $_name, $_userId;
    protected PDO $_dbConnection;

    //Constructor
    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getdbConnection();
    }

    //function to verify the existence of a user
    public function verifyUser($email, $pwd)
    {
        $sqlQuery = "SELECT * FROM UsersTable WHERE email_address = :email"; //Query to get user data from the database
        $statement = $this->_dbConnection->prepare($sqlQuery); //prepare the PDO statement
        $statement->bindParam(':email', $email, PDO::PARAM_STR); //Bind variable to :email with parameter $email
        $statement->execute();

        if($statement->rowCount() == 1)
        {
            $dbRow = $statement->fetch();
            $this->_name = $dbRow['full_name']; //assigning the row to the name variable
            $this->_userId = $dbRow['UserId']; //assigning the row to the userId variable
            $encryptedPwd = $dbRow['password']; //assigning the row to the encrypted password variable

            if (password_verify($pwd, $encryptedPwd)) //if statement to verify the password and returns true or false
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else{
            return false;
        }
    }

    //function to register a user
    public function registerUser($name, $email, $pwd)
    {
        //change the password to a hash first
        $pass = password_hash($pwd, PASSWORD_DEFAULT);

        //Query to insert name, email and password
        $sqlQuery = "INSERT INTO UsersTable (full_name, email_address, password) VALUES (:full_name, :email, :pwd)";
        $statement = $this->_dbConnection->prepare($sqlQuery); //prepare the PDO statement
        $statement->bindParam(':full_name', $name, PDO::PARAM_STR); //Bind variable to :full_name with parameter $name
        $statement->bindParam(':email', $email, PDO::PARAM_STR); //Bind variable to :email with parameter $email
        $statement->bindParam(':pwd', $pass, PDO::PARAM_STR); //Bind variable to :pwd with parameter $pass

        $statement->execute();
    }

    //function to confirm the email of a user
    public function checkEmail($email)
    {

        $sqlQuery = "SELECT email_address FROM UsersTable WHERE email_address = :email"; //Query to select email address from database
        $statement = $this->_dbConnection->prepare($sqlQuery); //prepare the PDO statement
        $statement->bindParam(':email', $email, PDO::PARAM_STR); //Bind variable to :email with parameter $email
        $statement->execute();

        if($statement->rowCount() > 0) //return true or false when the row is found
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //Accessor method to get the name of user
    //Gets the name
    public function getName()
    {
        return $this->_name;
    }

    //Accessor method to get the ID of the user
    //Gets the Id
    public function getId()
    {
        return $this->_userId;
    }
}