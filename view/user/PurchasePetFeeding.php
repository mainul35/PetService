<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if (!isset($_SESSION['username'])) {
    header("location: ../login.php");
} else {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['submit'])) {
            include_once '../../config/config.php';
            $manager = Config::getManager();
            $manager->selectDB('petservice');
            $petName = $_POST['petName'];
//            $totalUnits = $_POST['totalUnit'];
            $date = $_POST['date'];
            $sql = "INSERT INTO booking(`dateTime`, `serviceId`, `petId`, `unit`)
                SELECT '" . $date . "', service.serviceId, pet.petId, '1'
                FROM service, pet, customer
                WHERE service.serviceName = 'Pet Walking'
                AND pet.petName = '" . $petName . "'
                AND pet.userId = customer.userId
                AND customer.username = '" . $_SESSION['username'] . "';";
            $result = $manager->query($sql);
            if (mysqli_error($manager->getConnection())) {
                echo 'Error encountered. ' . mysqli_error($manager->getConnection()) . " at line no. " . mysqli_errno($manager->getConnection()) . "<br>";
            } else {
                ?><script>alert("Service booked successfully.");</script><?php
            }
        }
    }
    include_once './navbar.php';
    include_once './RightNav.php';
    ?>
    <head>
        <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../../css/bootstrap-theme.css"/>
        <link rel="stylesheet" href="../../css/w3.css"/>
        <link rel="stylesheet" href="../../css/style.css"/>
        <link rel="stylesheet" href="../../css/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
        <script type="text/javascript" src="../../js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../css/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
        <style>
            .form-div{
                margin: -40% 10% 10% 30%;
                border-radius: 5px;
                border: 1px solid #239585;
                padding: 2%;
                width: 48%;
                padding-left: 5%;
                background-color: #2DD8C0;
            }

            .form-control{
                width: 300px;;
            }
        </style>
    </head>
    <div class="form-div">
        <form class="w3-container" method="post" action="PurchasePetFeeding.php">

            <table>
                <thead>
                <h3 style="text-align: center;">Book for Pet feeding</h3>
                </thead>
                <tr>
                    <td colspan="2"><p style="text-align: center;">(£3 Per feeding)</p></td>
                </tr>
                <tr>
                    <td>
                        <label for="petName">Select Pet</label>
                    </td>
                    <td>
                        <select name="petName">
                            <?php
                            include_once '../../config/config.php';
                            $manager = Config::getManager();
                            $manager->selectDB('petservice');
                            $sql = "SELECT `petName` FROM `pet`, `customer` WHERE `pet`.`userId` = `customer`.`userId` AND customer.username = '" . $_SESSION['username'] . "';";
                            $result = $manager->query($sql);
                            while ($arr = $manager->fetchAssociativeArray($result)) {
                                echo "<option value='" . $arr['petName'] . "'>" . $arr['petName'] . "</option><br>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="date">Enter Date</label>
                    </td>
                    <td>
                        <div class="input-group date form_datetime col-md-5" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                            <input class="form-control" size="16" type="text" value=""  readonly style="width: 300px;">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                        </div>
                        <input type="hidden" name="date" id="dtp_input1" value="" /><br/>

                        <script type="text/javascript">
                    $(".form_datetime").datetimepicker({
                        format: "dd MM yyyy - HH:ii P",
                        showMeridian: true,
                        autoclose: true,
                        todayBtn: true
                    });
                        </script>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input style="margin-left: 60vh;" class="w3-btn w3-white w3-border w3-border-blue w3-round" type="submit" name="submit" value="Book time"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php
}
?>