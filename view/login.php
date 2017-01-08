<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['signedEmail'])) {
        if (isset($_POST['submit'])) {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                include_once '../controller/LoginController.php';
                $loginController = new LoginController();
                $email = $_POST['email'];
                $password = $_POST['password'];
                if ($loginController->checkLogin($email, $password) == true) {
                    echo 'Welcome, ' . $_SESSION['signedEmail'];
                } else {
                    echo 'Invalid login.';
                }
            }
        }
    }
} else {
    ?>
    <?php include_once './header.html'; ?>
    <link rel="stylesheet" href="../css/w3.css"/>
    <link rel="stylesheet" href="../css/style.css"/>
    <div class="form-div">
        <form class="w3-container" method="post" action="login.php">
            <table>
                <tr>
                    <td>
                        <label for="email">Email</label>
                    </td>
                    <td>
                        <input class="w3-input" type="email" name="email"/>
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
                        <a style="font-size: 12px;" href="">Forgot password?</a>
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
?>