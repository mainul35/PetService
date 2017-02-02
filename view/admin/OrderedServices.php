<?php
session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../header.html';
include_once './RightNav.php';
?>
<head>
    <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../css/bootstrap-theme.css"/>
    <link rel="stylesheet" href="../../css/w3.css"/>
    <link rel="stylesheet" href="../../css/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
    <script type="text/javascript" src="../../js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="../../css/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="../../css/style.css"/>
    <style>
        .orders-div{
            width: 1054px;
            margin-top: -850px;
            margin-left: 255px;
        }
    </style>
</head>
<?php
if (isset($_SESSION['username'])) {
    if ($_SESSION['username'] == 'adminlucey') {
        include_once '../../config/config.php';
        $manager = Config::getManager();
        $manager->selectDB('petservice');
        $sql = "SELECT booking.bookingId, customer.name, booking.dateTime, pet.petName, pet.petImage, service.serviceName, booking.unit, (booking.unit*service.costPerUnit) AS serviceCost
FROM customer, booking, pet, service
WHERE customer.userId = pet.userId
AND pet.petId = booking.petId
AND booking.serviceId = service.serviceId
AND booking.confirmed = 0;";

        $rs = $manager->query($sql);
//        $row = $manager->fetchAssociativeArray($rs);
//        print_r($rs);
        ?>
        <div class="orders-div">
            <h2>All Orders</h2><hr>
            <table class="table">
                <col width="20">
                <col width="200">
                <col width="210">
                <tr><th>ID</th><th>Name</th><th>Date Time</th><th>Pet Name</th><th>Image</th><th>Service</th><th>Units</th><th>Service cost</th><th>Confirm</th></tr>  
                <?php
                $tr = "";
                while ($row = $manager->fetchAssociativeArray($rs)) {
                    $tr .= "<tr>";
                    $tr .= "<td>" . $row['bookingId'] . "</td>";
                    $tr .= "<td>" . $row['name'] . "</td>";
                    $tr .= "<td>" . $row['dateTime'] . "</td>";
                    $tr .= "<td>" . $row['petName'] . "</td>";
                    $tr .= "<td><img width='100px' height='100px' src='" . $row['petImage'] . "'/></td>";
                    $tr .= "<td>" . $row['serviceName'] . "</td>";
                    $tr .= "<td>" . $row['unit'] . "</td>";
                    $tr .= "<td>" . $row['serviceCost'] . "</td>";
                    $tr .= "<td><a href='confirm.php?id=" . $row['bookingId'] . "'>Confirm</a></td>";
                    $tr .= "</tr>";
                }
                echo $tr;
                ?>
            </table>
        </div>
        <?php
    }
}