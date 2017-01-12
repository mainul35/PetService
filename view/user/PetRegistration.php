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
        include_once '../../controller/ImageUploadController.php';
        include_once '../../config/config.php';
        $petName = $_POST['petName'];
        $petAge = $_POST['petAge'];
        $petType = $_POST['petType'];
        $fileName = $_FILES["petImage"]["name"];
        $tempName = $_FILES["petImage"]["tmp_name"];
        $size = $_FILES["petImage"]["size"];
        $imageUploadController = new ImageUploadController();
        $manager = Config::getManager();
        $manager->selectDB('petservice');
        $sql = "SELECT `userId` FROM customer WHERE `username` = '" . $_SESSION['username'] . "'";
        $result = $manager->query($sql);
        $userId = $manager->fetchArray($result)[0];
        $sql = "SELECT `petTypeId` FROM `pettype` WHERE `petType` = '".$petType."';";
        $result = $manager->query($sql);
        $petTypeId = $manager->fetchArray($result)[0];
        
        $sql = "INSERT INTO pet(`petName`, `petTypeId`,`petAge`, `userId`) VALUES('".$petName."', '".$petTypeId."', '".$petAge."', '".$userId."');";
        $result = $manager->query($sql);
        $petId = mysqli_insert_id($manager->getConnection());
        $imageUploadController->uploadImage($manager, $fileName, $tempName, $size, $petId);
    }
}
include_once './navbar.php';
?>
<head>
    <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../css/bootstrap-theme.css"/>
    <link rel="stylesheet" href="../../css/w3.css"/>
    <link rel="stylesheet" href="../../css/style.css"/>
</head>
<div class="form-div">
    <form class="w3-container" method="post" action="PetRegistration.php" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <label for="petName">Pet Name</label>
                </td>
                <td>
                    <input class="w3-input" type="text" name="petName"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="petAge">Pet Age</label>
                </td>
                <td>
                    <input class="w3-input" type="number" name="petAge"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="petType">Pet Type</label>
                </td>
                <td>
                    <select name="petType">
                    <?php
                    include_once '../../config/config.php';
                    $manager = Config::getManager();
                    $manager->selectDB('petservice');
                    $sql = "SELECT `pettype`.`petType` FROM `pettype`;";
                    $result = $manager->query($sql);
                    while ($arr = $manager->fetchAssociativeArray($result)) {
                        echo "<option value='" . $arr['petType'] . "'>" . $arr['petType'] . "</option><br>";
                    }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="petImage">Pet Image</label>
                </td>
                <td>
                    <input class="w3-input" type="file" name="petImage"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input style="margin-left: 60vh;" class="w3-btn w3-white w3-border w3-border-blue w3-round" type="submit" name="submit" value="Add Pet"/>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php
}
?>