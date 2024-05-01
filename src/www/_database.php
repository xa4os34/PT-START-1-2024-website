<?php

if (strtolower(getenv("USE_ENV_CONFIGURATION")) == "true"){
    $connection = new mysqli(
        getenv("MYSQL_HOST"),
        getenv("MYSQL_USER"),
        getenv("MYSQL_PASSWORD"),
        getenv("MYSQL_DATABASE"),
        getenv("MYSQL_PORT"));
}
else {
    $options = parse_ini_file("php.ini");
    $connection = new mysqli(
        $options["host"],
        $options["username"],
        $options["password"], 
        $options["database"], 
        $options["port"]);
}
if (!isset($connection)) 
    die();

$EscapeSql = function (string $value) : string {
    global $connection;
    return $connection->escape_string($value);
}; // php is wierd.


function IsUsernameInUse(string $username) : bool {
    global $connection, $EscapeSql;
    $result = $connection->query(
        "SELECT 'TRUE' FROM Users WHERE Username = '{$EscapeSql($username)}'");

    return $result->fetch_column(0) == "TRUE";
}

function IsEmailInUse(string $email) : bool {
    global $connection, $EscapeSql;
    $result = $connection->query(
        "SELECT 'TRUE' FROM Users WHERE Email = '{$EscapeSql($email)}'");

    return $result->fetch_column(0) == "TRUE";
}

function CreateUser(
    string $username, string $email,
    string $passwordHash) : ?int {

    global $connection, $EscapeSql;
    $result = $connection->query(
        "INSERT INTO Users (Username, Email, PasswordHash)
         VALUES ('{$EscapeSql($username)}', '{$EscapeSql($email)}',
                 '{$EscapeSql($passwordHash)}')");

    if (!$result)
        return null;
    
    return $connection->insert_id; 
}

function GetUserById(int $id) : ?User {
    global $connection;
    $result = $connection->query(
        "SELECT Id, Username, Email, PasswordHash FROM Users 
         WHERE Id = {$id}");

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
    global $connection, $EscapeSql;
    $result = $connection->query(
        "SELECT Id, Username, Email, PasswordHash FROM Users
         WHERE Username = '{$EscapeSql($username)}'");

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

function GetUserPosts(int $userId) : ?array {
    global $connection, $EscapeSql;
        
    $user = GetUserById($userId);

    if ($user == null)
        return null;

    $result = $connection->query(
        "SELECT Id, Title, Content, TitleImage FROM Posts
         WHERE OwnerId = '{$EscapeSql($userId)}'");

    if ($result == null)
        return null;

    $posts = array();

    while($row = $result->fetch_assoc()) {
        array_push($posts, new Post(
            $row['Id'], $row['Title'], 
            $row['Content'], $row['TitleImage'],
            $user));
    }
    
    return $posts;
}

function GetPosts() : ?array {
    global $connection;

    $result = $connection->query(
        "SELECT post.Id, post.Title, post.Content, post.TitleImage, 
                user.Id, user.Username, user.Email
             FROM Posts AS post
                  LEFT JOIN Users AS user 
                  ON post.OwnerId = user.Id
         ORDER BY post.Title;");

    if ($result == null)
        return null;

    $posts = array();

    while($row = $result->fetch_row()) {
        array_push($posts, new Post(
            $row[0], $row[1], 
            $row[2], $row[3],
            new User (
                $row[5], $row[6], 
                null, $row[4])));
    }
    
    return $posts;
}

function GetPostById(int $postId) : ?Post {
    global $connection;

    $result = $connection->query(
        "SELECT post.Id, post.Title, post.Content, post.TitleImage, 
                user.Id, user.Username, user.Email
             FROM Posts AS post
                 LEFT JOIN Users AS user 
                 ON post.OwnerId = user.Id
         WHERE post.Id = {$postId};");

    if ($result == null)
        return null;

    $row = $result->fetch_row();

    if ($row == null)
        return null;

    return new Post(
        $row[0], $row[1], 
        $row[2], $row[3],
        new User (
            $row[5], $row[6], 
            null, $row[4]));
}

function CreatePost(
    string $title, string $content,
    ?string $titleImage, int $ownerId) : ?int {

    global $connection, $EscapeSql;
    // Very readable code. I think. Yeah, now it's readable. (I love myself)
    $titleImage = $titleImage == null ? "DEFAULT" : "'$titleImage'";
    $result = $connection->query(
        "INSERT INTO Posts (Title, Content, OwnerId, TitleImage) 
         VALUES ('{$EscapeSql($title)}', '{$EscapeSql($content)}', 
                 $ownerId, {$EscapeSql($titleImage)});");

    if (!$result)
        return null;

    return $connection->insert_id; 
}

class User {
    public readonly int $Id;
    public readonly string $Username;
    public readonly string $Email;
    public readonly ?string $PasswordHash;

    public function __construct(
        string $username, string $email,
        ?string $passwordHash, int $id) {

        $this->Username = $username;
        $this->Email = $email;
        $this->PasswordHash = $passwordHash;
        $this->Id = $id;
    }
}

class Post {
    public readonly int $Id;
    public readonly string $Title;
    public readonly string $Content;
    public readonly string $TitleImage;
    public readonly User $Owner;
    
    public function __construct(
        int $id, string $title, 
        string $content, string $titleImage,
        User $owner){
        
        $this->Id = $id;
        $this->Title = $title;
        $this->Content = $content;
        $this->TitleImage = $titleImage;
        $this->Owner = $owner;
    }
}

?>
