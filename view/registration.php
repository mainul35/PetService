<?php
session_start();
if (!isset($_SESSION['username'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['submit'])) {
            include_once '../controller/RegistrationController.php';
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $address = $_POST['address'];
            $contactNo = $_POST['contact'];
            $sex = $_POST['sex'];
            if ($name == "") {
                echo 'Please enter a name.<br>';
            } else {
                if ($email == "" || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
                    echo 'Invalid email.';
                } else {
                    if ($password == "" || !preg_match("#.*^(?=.{8})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
                        echo 'Invalid password.';
                    } else {
                        $registrationController = new RegistrationController($name, $username, $email, $password, $address, $contactNo, $sex);
                    }
                }
            }
        }
    } else {
        ?>
        <?php include_once './header.html'; ?>
        <link rel="stylesheet" href="../css/w3.css"/>
        <link rel="stylesheet" href="../css/style.css"/>
        <script src="../js/jquery-3.1.1.min.js"></script>
        <script>
            isNotName = false;
            isNotUserName = false;
            isInvalidEmail = false;
            isInvalidReEmail = false;
            isInvalidPassword = false;
            isInvalidRePassword = false;
            $(document).ready(function () {

                $("[name='name']").focusout(
                        function () {
                            val = $("[name='name']").val();
                            if (val == "") {
                                isNotName = true;
                                $("[name='name']").css("background-color", "#ffe6f2");
                            } else {
                                isNotName = false;
                                $("[name='name']").css("background-color", "#ffffff");
                            }
                        }
                );

                $("[name='username']").focusout(
                        function () {
                            val = $("[name='username']").val();
                            if (val == "") {
                                isNotUserName = true;
                                $("[name='username']").css("background-color", "#ffe6f2");
                            } else {
                                isNotUserName = false;
                                $("[name='username']").css("background-color", "#ffffff");
                            }
                        }
                );

                $("[name='email']").focusout(function () {
                    var userinput = $("[name='email']").val();
                    var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i

                    if (!pattern.test(userinput)) {
                        isInvalidEmail = true;
                        $("#invalidMail").text("Invalid email");
                        $("[name='email']").css("background-color", "#ffe6f2");
                    } else {
                        isInvalidEmail = false;
                        $("[name='email']").css("background-color", "#ffffff");
                        $("#invalidMail").text("");
                    }
                });

                $("[name='re-email']").focusout(function () {
                    var firstEmail = $("[name='email']").val();
                    var reemail = $("[name='re-email']").val();
                    if (firstEmail != reemail) {
                        isInvalidReEmail = true;
                        $("#invalidMail2").text("Email missmatched.");
                        $("[name='re-email']").css("background-color", "#ffe6f2");
                    } else {
                        isInvalidReEmail = false;
                        $("[name='re-email']").css("background-color", "#ffffff");
                        $("#invalidMail2").text("");
                    }
                });
                $("[name='password']").focusout(function () {
                    var pattern = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                    var pass = $("[name='password']").val();
                    if (!pattern.test(pass)) {
                        isInvalidPassword = true;
                        $("[name='password']").css("background-color", "#ffe6f2");
                        $("#invalidPassword").text("Password is weak!");
                        $("p").html("To make strong password, \n\
                                        <br>Use at least 1 Uppercase character.\n\
                                        <br>At least 1 special character<br>\n\
                                        At least 1 number<br>\n\
                                        at least 1 small character\n\
                                        <br>and ensure your password is 8 characters long.");
                        $("#myModal").css("display", "block");
                    } else {
                        isInvalidPassword = false;
                        $("#invalidPassword").text("");
                        $("[name='password']").css("background-color", "#ffffff");
                    }

                });

                $("[name='re-password']").focusout(function () {
                    var pass = $("[name='password']").val();
                    var rePass = $("[name='re-password']").val();
                    if (pass != rePass) {
                        isInvalidRePassword = true;
                        $("#re-invalidPassword").text("Password missmatched!");
                        $("[name='re-password']").css("background-color", "#ffe6f2");
                    } else {
                        isInvalidRePassword = false;
                        $("#re-invalidPassword").text("");
                        $("[name='re-password']").css("background-color", "#ffffff");
                    }
                });
                $("[name='submit']").click(function () {
                    if ($("[name='name']").val() == ""
                            && $("[name='email']").val() == ""
                            && $("[name='re-email']").val() == ""
                            && $("[name='password']").val() == ""
                            && $("[name='re-password']").val() == "") {
                        $("p").text("Sorry, All fields are empty.");
                        $("#myModal").css("display", "block");
                        return false;
                    } else {
                        var message = "";
                        if (isNotName == true || $("[name='name']").val() == "") {
                            message += "Name field is empty.<br>";
                        }
                        if (isNotUserName == true || $("[name='username']").val() == "") {
                            message += "Username field is empty.<br>";
                        }
                        if (isInvalidEmail == true || isInvalidReEmail == true || $("[name='email']").val() == "" || $("[name='re-email']").val() == "") {
                            message += "Invalid email.<br>";
                        }
                        if (isInvalidPassword == true || isInvalidRePassword == true || $("[name='password']").val() == "" || $("[name='re-password']").val() == "") {
                            message += "Invalid password.<br>";
                        }
                        if (message != "") {
                            $("p").html(message);
                            $("#myModal").css("display", "block");
                            return false;
                        }
                    }
                });
                $("span").click(function () {
                    $("#myModal").css("display", "none");

                });
            });

        </script>
        <div class="form-div">
            <form class="w3-container" method="post" action="registration.php">
                <table>
                    <tr>
                        <td>
                            <label for="name">Name*</label>
                        </td>
                        <td>
                            <input class="w3-input" type="text" name="name"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="username">Username*</label>
                        </td>
                        <td>
                            <input class="w3-input" type="text" name="username"/>
                        </td>
                        <td>
                            <span id="invalidMail"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email">Email*</label>
                        </td>
                        <td>
                            <input class="w3-input" type="email" name="email"/>
                        </td>
                        <td>
                            <span id="invalidMail"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="re-email">Re-enter Email</label>
                        </td>
                        <td>
                            <input class="w3-input" type="email" name="re-email"/>
                        </td>
                        <td>
                            <span id="invalidMail2"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="address">Address</label>
                        </td>
                        <td>
                            <input class="w3-input" type="text" name="address"/>
                        </td>
                        <td>
                            <span id="address"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="contact">Contact</label>
                        </td>
                        <td>
                            <input class="w3-input" type="text" name="contact"/>
                        </td>
                        <td>
                            <span id="contact"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="sex">Sex</label>
                        </td>
                        <td>
                            <select name="sex">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="password">Password*</label>
                        </td>
                        <td>
                            <input class="w3-input" type="password" name="password"/>
                        </td>
                        <td>
                            <span id="invalidPassword"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="re-password">Re-enter Password</label>
                        </td>
                        <td>
                            <input class="w3-input" type="password" name="re-password"/>
                        </td>
                        <td>
                            <span id="re-invalidPassword"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>Already have an account?<a style="font-size: 12px;" href=""><br>Login</a>
                        </td>
                        <td>
                            <input style="margin-left: 20vh;" class="w3-btn w3-white w3-border w3-border-blue w3-round" type="submit" name="submit" value="Sign in"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Some text in the Modal..</p>
            </div>

        </div>
        <?php
    }
}
?>