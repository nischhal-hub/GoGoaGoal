<?php require '../../conn/conn.php';
session_start();
$userName = $_POST['name'];
$userPassword = $_POST['password'];

$stmt = $conn->prepare("SELECT user_password FROM users WHERE user_name = ?");
$stmt->bind_param("s", $userName);


$stmt->execute();
$stmt->store_result();


if ($stmt->num_rows == 1) {
    $stmt->bind_result($password);
    $stmt->fetch();
    if (password_verify($userPassword, $password)) {
        echo "Login successful!";
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username; 
        header("Location: ../../index.php"); // Change this to the URL of your dashboard
        exit();
    } else {
        $_SESSION['invalidlogin'] = true;
        header("Location: ../../login.php");
    }
} else {
    $_SESSION['invalidlogin'] = true;
    header("Location: ../../login.php");
}

$stmt->close();
$conn->close();
