<?php
session_start();
if (!isset($_SESSION['username'])) {
    $invalidLogin = true;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['submit'])) {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                include_once '../controller/LoginController.php';
                $loginController = new LoginController();
                $username = $_POST['username'];
                $password = $_POST['password'];
                if ($loginController->checkLogin($username, $password) == true) {
                    $_SESSION['username'] = $username;
                    header("location: userhome.php");
                    $invalidLogin = FALSE;
                } else {
                    $invalidLogin = true;
                }
            }
        }
    }
    if ($invalidLogin == true) {
        ?>
        <?php include_once './header.html'; ?>
        <link rel="stylesheet" href="../css/w3.css"/>
        <link rel="stylesheet" href="../css/style.css"/>
        <div class="form-div">
            <form class="w3-container" method="post" action="login.php">
                <table>
                    <tr>
                        <td>
                            <label for="username">Username</label>
                        </td>
                        <td>
                            <input class="w3-input" type="username" name="username"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="password">Password</label>
                        </td>
                        <td>
                            <input class="w3-input" type="password" name="password"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Not a member? <a style="font-size: 12px;" href="registration.php">register</a>
                        </td>
                        <td>
                            <input style="margin-left: 20vh;" class="w3-btn w3-white w3-border w3-border-blue w3-round" type="submit" name="submit" value="Sign in"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php
    }
} else {
    echo 'ghjk';
    header("location: userhome.php");
}
?>