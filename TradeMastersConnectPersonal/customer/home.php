<?php

    session_start();

    if (!isset($_SESSION['username']) || $_SESSION['role'] != 'customer'){
        header('Location: ../prepages/login.php');
    }

    require("../configDB/configDatabase.php");

    if (!$conn){
        echo "Connection Failed.";
    }

    //array which associates skills with each technician data
    $tech_skills = [
        'Plumber' => [], 
        'Dish Technician' => [],
        'Carpentener' => []
    ];

    $technicians = []; //associative array used to store the data from technicians table

    $sql = "select * from technician";
    $result = $conn -> query($sql);
    while ($row = $result -> fetch_assoc()){
        $technicians[$row['UserName']] = $row;
    }

    $sql = "select * from technician_skill";
    $result = $conn -> query($sql);

    while ($row = $result -> fetch_assoc()){
        $tech_skills[$row['SkillTitle']][] = $row;

    }

    
    
    
    $_SESSION['technicians'] = $technicians;
    $_SESSION['techSkills'] = $tech_skills;

    
?>  

<!DOCTYPE html>
<html>
    <head>
        <title>Home Owner</title>
        <link rel="stylesheet" href="home.css">
    </head>
    <body>
        <!-- Doing the header -->
        <?php 
            require('../template/header.php');
        ?>
        
        <div id="central">
            <?php
                require('customerNav.php');
            ?>

            <!-- The main contents -->
            <main>
                <!-- <legend>Plumbers</legend> -->
                
                <?php foreach ($tech_skills as $skill => $info){ ?>
                    <fieldset>
                        <legend><?php echo $skill //the skill title ?></legend>
                        <?php foreach($info as $row){ ?>
                            <div class="cards" onclick="viewTechnician('<?php echo $row['TechUserName'] ?>')" >
                                <div class="photo-container">
                                
                                </div>
                                <div class="technician-info">
                                    
                                    <p class="technician-name">
                                        <?php 
                                            $techUserName = $row['TechUserName'];
                                            $firstName = $technicians[$techUserName]['First Name'];
                                            $fatherName = $technicians[$techUserName]['Father Name'];
                                            echo $firstName . " " . $fatherName;
                                        ?> 
                                    </p>
                                    <div class="rating"><?php echo $row["Rating"] ?></div>
                                </div>
                            </div>
                        <?php }?>
                    </fieldset>
                <?php }?>
            </main>
        </div>

        <?php
            require('../template/footer.php');
        ?>

        <script src="home.js"></script>
    </body>
</html>
