<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])){ 
    header("HTTP/1.1 302 Moved Temporarily");
    header("Location: error404");
    exit;
}

$options = parse_ini_file("php.ini");
$connection = new mysqli(
    $options["host"],
    $options["username"],
    $options["password"], 
    $options["database"], 
    $options["port"]);

if (!isset($connection)) 
    die();

function IsUsernameInUse(string $username) : bool {
    global $connection;
    $result = $connection->query(
        "SELECT 'TRUE' FROM Users WHERE Username = '{$username}'");

    return $result->fetch_column(0) == "TRUE";
}

function IsEmailInUse(string $email) : bool {
    global $connection;
    $result = $connection->query(
        "SELECT 'TRUE' FROM Users WHERE Email = '{$email}'");

    return $result->fetch_column(0) == "TRUE";
}

function CreateUser(
    string $username, string $email, string $passwordHash) : ?int {
    global $connection;
    $result = $connection->query(
        "INSERT INTO Users (Username, Email, PasswordHash)
         VALUES ('{$username}', '{$email}', '{$passwordHash}')");

    if (!$result)
        return null;
    
    return $connection->insert_id; 
}

function GetUserById(int $id) : ?User {
    global $connection;
    $result = $connection->query(
        "SELECT Id, Username, Email, PasswordHash FROM Users WHERE Id = {$id}");

    if ($result == null)
        return null;

    $result = $result->fetch_row();

    if ($result == null)
        return null;

    return new User(
        id: $result[0],
        username: $result[1],
        email: $result[2],
        passwordHash: $result[3]);
}

function GetUserByUsername(string $username) : ?User {
    global $connection;
    $result = $connection->query(
        "SELECT Id, Username, Email, PasswordHash FROM Users WHERE Username = '{$username}'");

    if ($result == null)
        return null;

    $result = $result->fetch_row();

    if ($result == null)
        return null;

    return new User(
        id: $result[0],
        username: $result[1],
        email: $result[2],
        passwordHash: $result[3]);
}

class User {
    public readonly ?int $Id;
    public readonly string $Username;
    public readonly string $Email;
    public readonly string $PasswordHash;

    public function __construct(
        string $username, string $email, string $passwordHash, int $id) {
        $this->Username = $username;
        $this->Email = $email;
        $this->PasswordHash = $passwordHash;
        $this->Id = $id;
    }
}

?>
