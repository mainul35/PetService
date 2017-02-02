<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
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
        .form-div{
            margin: -40% 10% 10% 30%;
            border-radius: 5px;
            border: 1px solid #239585;
            padding: 2%;
            width: 48%;
            padding-left: 5%;
            background-color: #2DD8C0;
        }

        /*        .row{
                    margin-left: 10px;
                    margin-top: -15px;
                }*/

        .form-control{
            width: 300px;;
        }

        .all-uploads{
            width: 165px;
            height: 165px;
            margin-left: 3vh;
            margin-top: 5vh;
            border-radius: 4px;
        }

        .all-uploads-inf{
            line-height: -2px;
            margin-left: 3vh;
        }

        .imgContainer{
            background-color: lavender;
            margin-left: 16px;
            width: 220px;
        }

        .delete {
            padding: 5px;
            background-color: lightblue;
            margin-top: 20px;
            /*position: absolute;*/
        }

        @media (min-width: 768px){
            .col-lg-3 {
                width: 16.333333%;
                float: left;
                /*height: 310px;*/
            }
        }
    </style>
</head>
<?php
if (!isset($_SESSION['username'])) {
    header("location: ../login.php");
} else {
    include_once '../../config/config.php';
    $manager = Config::getManager();
    $manager->selectDB('petservice');

    $sql = "SELECT * FROM pet WHERE pet.userId = (SELECT customer.userId FROM customer WHERE customer.username = '" . $_SESSION['username'] . "');";
    $rs = $manager->query($sql);
    $petList = array();
    $i = 0;
    while ($row = $manager->fetchAssociativeArray($rs)) {
        $petList[$i++] = $row;
    }
    include_once './navbar.php';
    ?>

    <div class="container-fluid">
        <h2>My Pets</h2>
        <hr>
        <div class="row">
            <script>
                $(document).ready(function () {
                    var phpData = '<?php echo json_encode($petList); ?>';
                    var parseJSON = jQuery.parseJSON(phpData);
                    var content = "";
                    for (var i = 0; i < parseJSON.length; i++) {
                        content += "<div class='imgContainer col-sm-1' style='background-color:lavender;'>";
                        content += "<a href='" + parseJSON[i].petImage + "'><img class='all-uploads' src='" + parseJSON[i].petImage + "'/></a><br>";
                        content += "<span class='all-uploads-inf'>" + parseJSON[i].petName + "</span><br>";
                        content += "<span class='all-uploads-inf'>Age: " + parseJSON[i].petAge + " </span><br>";
                        content += "<a class='all-uploads-inf' href='DeletePet.php?petId=" + parseJSON[i].petId + "'>Delete</a></div>";
                        $("div.row").html(content);
                    }
                });
            </script>
        </div>
    </div>
    <?php
}
?>
