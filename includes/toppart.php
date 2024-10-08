<?php require './conn/conn.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io /apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io /favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io /favicon-16x16.png">
    <link rel="stylesheet" href="./global.css">
    <script src="./script/index.js" defer></script>
    <script src="https://kit.fontawesome.com/c8e33eec07.js" crossorigin="anonymous"></script>
    <title>GogoaGoal</title>
</head>

<body>
    <main>
        <?php include 'sidebar.php' ?>
        <section>
            <header>
                <div id="sidebar-space" class="sidebar-space"></div>
                <div class="head-container">
                    <div class="logo">
                        <button class="toggle-btn" id="toggle"><i class="fa-solid fa-bars fa-2xl"></i></button>
                        <img src="./assets/logo.png" width="70" alt="gogoagoal logo">
                    </div>
                    <form action="./proccess/auth/logout.php" method="POST">
                        <button type="submit" name="logout" class="primary-btn">Logout</button>
                    </form>
                </div>
            </header>
        </section>