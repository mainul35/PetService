<link rel="stylesheet" href="../css/bootstrap.min.css"/>
<link rel="stylesheet" href="../css/style.css"/>
<?php
include_once '../view/header.html';
?>
<div class="row" style="text-align:center;">
    <div class="col-sm-4 setup-page w3-teal">
        <?php
        include_once './config.php';
        /*
         * To change this license header, choose License Headers in Project Properties.
         * To change this template file, choose Tools | Templates
         * and open the template in the editor.
         */

        $sql = "DROP DATABASE if exists `petService`";
        $manager = Config::getManager();
        $manager->query($sql);
        if (mysqli_error($manager->getConnection())) {
            echo 'Error encountered.' . mysqli_error($manager->getConnection()) . "<br>";
        } else {
            echo 'Database dropped successfully.<br>';
        }

        $sql = "create database if not exists `petService`;";
        $manager->query($sql);
        if (mysqli_error($manager->getConnection())) {
            echo 'Error encountered.' . mysqli_error($manager->getConnection()) . "<br>";
        } else {
            echo 'Database created successfully.<br>';
        }

        $sql = "use `petService`";
        $manager->query($sql);
        if (mysqli_error($manager->getConnection())) {
            echo 'Error encountered. ' . mysqli_error($manager->getConnection()) . "<br>";
        } else {
            echo 'Database selected successfully.<br>';
        }

        $sql = "CREATE TABLE customer(
                userId INT(10) NOT NULL AUTO_INCREMENT,
                username VARCHAR(50) NOT NULL,
		email VARCHAR(100) NOT NULL,
		password VARCHAR(50) NOT NULL,
		name VARCHAR(100) NOT NULL,
		userType ENUM('admin','user') NOT NULL DEFAULT 'user',
		address VARCHAR(250) NOT NULL,
		contactNo VARCHAR(100) NOT NULL,
		sex ENUM('male','female','other') NOT NULL,
		PRIMARY KEY  (userId)
		) ENGINE = InnoDB;";
        $manager->query($sql);
        if (mysqli_error($manager->getConnection())) {
            echo 'Error encountered. ' . mysqli_error($manager->getConnection()) . " at line no. " . mysqli_errno($manager->getConnection()) . "<br>";
        } else {
            echo '\'customer\' table created successfully.<br>';
        }

        $sql = "CREATE TABLE petType ( "
                . "`perTypeId` INT(10) NOT NULL AUTO_INCREMENT ,"
                . " `perType` VARCHAR(100) NOT NULL ,"
                . " PRIMARY KEY (`perTypeId`)) ENGINE = InnoDB;";
        $manager->query($sql);
        if (mysqli_error($manager->getConnection())) {
            echo 'Error encountered. ' . mysqli_error($manager->getConnection()) . " at line no. " . mysqli_errno($manager->getConnection()) . "<br>";
        } else {
            echo '\'petType\' table created successfully.<br>';
        }
        
        $sql = "CREATE TABLE pet(
                petId INT(10) NOT NULL AUTO_INCREMENT,
		petName VARCHAR(100) NOT NULL,
		petTypeId INT(10) NOT NULL,
		petAge INT NOT NULL,
		userId INT(10) NOT NULL,
		PRIMARY KEY (petId),
		FOREIGN KEY (userId) REFERENCES customer(userId))";
        $manager->query($sql);
        if (mysqli_error($manager->getConnection())) {
            echo 'Error encountered. ' . mysqli_error($manager->getConnection()) . " at line no. " . mysqli_errno($manager->getConnection()) . "<br>";
        } else {
            echo '\'pet\' table created successfully.<br>';
        }

        $sql = "ALTER TABLE `pet` ADD `petImage` VARCHAR(255) NOT NULL AFTER `petName`;";
        $manager->query($sql);
        if (mysqli_error($manager->getConnection())) {
            echo 'Error encountered. ' . mysqli_error($manager->getConnection()) . " at line no. " . mysqli_errno($manager->getConnection()) . "<br>";
        }
        
        $sql = "CREATE TABLE service(
                serviceId INT(10) NOT NULL AUTO_INCREMENT,
		serviceName VARCHAR(100) NOT NULL,
		serviceType VARCHAR(100) NOT NULL,
		unit INT NOT NULL,
		cost FLOAT(10,2) NOT NULL,
		PRIMARY KEY (serviceId))";
        $manager->query($sql);
        if (mysqli_error($manager->getConnection())) {
            echo 'Error encountered. ' . mysqli_error($manager->getConnection()) . " at line no. " . mysqli_errno($manager->getConnection()) . "<br>";
        } else {
            echo '\'service\' table created successfully.<br>';
        }

        $sql = "CREATE TABLE booking (
		bookingId INT(10) NOT NULL AUTO_INCREMENT,
		dateTime DATETIME NOT NULL,
		serviceId INT(10) NOT NULL,
		petId INT(10) NOT NULL,
		unit INT(10) NOT NULL,
		costPerUnit FLOAT(10,2) NOT NULL,
		PRIMARY KEY (bookingId)
		)";
        $manager->query($sql);
        if (mysqli_error($manager->getConnection())) {
            echo 'Error encountered. ' . mysqli_error($manager->getConnection()) . " at line no. " . mysqli_errno($manager->getConnection()) . "<br>";
        } else {
            echo '\'booking\' table created successfully.<br>';
        }

        $sql = "insert into customer values('1','adminlucey','admin@luceypet.com','".md5('Lucey@1234')."','Lucey','admin','Lucy\'s Pet Service Center','','female')";
        $manager->query($sql);
        if (mysqli_error($manager->getConnection())) {
            echo 'Error encountered. ' . mysqli_error($manager->getConnection()) . " at line no. " . mysqli_errno($manager->getConnection()) . "<br>";
        } else {
            echo 'Welcome, Lucey!<br>Your username address is: adminlucey <br>and password is Lucey@1234<br> Please log in and customize your profile.';
        }
        ?>
    </div>
</div>
<?php
include_once '../view/footer.html';
?>