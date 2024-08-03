<?php session_start(); ?>
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
    <link rel="stylesheet" href="login.css">
    <script src="./script/index.js" defer></script>
    <script src="https://kit.fontawesome.com/c8e33eec07.js" crossorigin="anonymous"></script>
    <title>GogoaGoal</title>
</head>

<body>
    <?php 
        if(isset($_SESSION['invalidlogin']) && $_SESSION['invalidlogin'] == true){
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                    var modal = document.getElementById('modal');
                    modal.style.display = 'block';
                    var closeBtn = document.getElementsByClassName('close')[0];
                        closeBtn.onclick = function() {
                            modal.style.display = 'none';
                            
                        }
            });
            </script>";
        }
    ?>

            <div id="modal" class="modal show">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p id="modal-message"><i class="fa-solid fa-circle-xmark fa-beat-fade fa-2xl" style="color: #e01b24; padding-right: 1rem;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Invalid username or password.</p>
                </div>
            </div>
    <main class="login-container">
        <section class="login-section-right">
            <div class="info">
                <div class="logo">
                    <img src="./assets/logo.png" alt="logo">
                </div>
                <p>Digitize your futsal arena.</p>
            </div>
        </section>
        <section class="login-section-left">
            <form class="form" action="./proccess/auth/login.php" method="post" id="itemIssueForm">
                <h3>Login</h3>
                <div>
                    <label for="name"><span>User name</span></label>
                    <input type="text" id="name" name="name" pattern="^[A-Za-z\s]+$" placeholder="admin"
                        required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <button class="primary-btn" type="submit" id="myBtn" style="width: 100%;">Submit</button>
                </div>
            </form>
            <span>For test purposes: Use username: <b>admin</b> and password: <b>admin</b></span>
        </section>
    </main>
</body>

</html>