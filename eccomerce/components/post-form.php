<?php

$name = $_POST["name"];
$email = $_POST["email"];
$location = $_POST["location"];
$message = $_POST["message"];
$phone = filter_input(INPUT_POST, "phone", FILTER_VALIDATE_INT);
$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOL);

if (! $terms){
    die("Terms must be accepted");
}

$host = "localhost";
$dbname = "form_db";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $dbname);


if(mysqli_connect_errno()){
    die("there is an error: " . mysqli_connect_error());
}
  
$sql = "INSERT INTO message (name, email, location, phone)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (! mysqli_stmt_prepare($stmt, $sql)){
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param( $stmt, "ssssi",
                        $name,
                        $message,
                        $email,
                        $phone);

mysqli_stmt_execute($stmt);

echo "Saved";

?>