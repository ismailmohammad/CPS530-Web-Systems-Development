<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./downloadedBootstrap.css" rel="stylesheet">
    <link href="./lab08.css" rel="stylesheet">
    <title>Lab 8 - SSP w/ PHP</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
</head>

<body>
    <?php
    // Halloween Image Base
    $halloween_image = $_GET['image'];
    $halloween_images = array("dracula1.gif", "ghoul.gif", "vampire1.gif");
    $display_halloween_image = $halloween_image && in_array($halloween_image, $halloween_images, TRUE);
    if ($display_halloween_image) echo "<img class='halloween-img' src='./images/halloween/{$halloween_image}' alt='Halloween Image'/>";
    // Time Greetings - figure out what time of day it is
    $time_colour_mappings = [
        "morning" => "warning",
        "afternoon" => "info",
        "evening" => "danger",
        "night" => "dark"
    ];
    $timeOfDay = date('G');
    switch (true) {
        case ($timeOfDay >= 5 && $timeOfDay <= 11):
            $greeting = 'morning';
            break;
        case ($timeOfDay >= 12 && $timeOfDay <= 16):
            $greeting = 'afternoon';
            break;
        case ($timeOfDay >= 17 && $timeOfDay <= 19):
            $greeting = 'evening';
            break;
        default:
            $greeting = 'night';
    }
    $greeting_image = "./images/{$greeting}.jpg";
    $greeting_text = $greeting;
    ?>
    <div class="container">
        <div class="row">
                <div class="card shadow problem">
                    <div class="card-body row">
                        <h1 class="title">Lab 8 - PHP</h1>
                    </div>
                </div>
                <div class="card shadow problem">
                    <h2 class="title">Problem 1 - Time-based Greeting</h2>
                    <div class="card-body row">
                        <div style="background-image: url('<?php echo $greeting_image;?>')" class="col card shadow inner-card time-based-greeting-div">
                            <h2 class="title inner-card time-based-greeting<?php echo " bg-{$time_colour_mappings[$greeting]}\">";echo "Good ".$greeting_text ?></h2>
                        </div>                    
                    </div>
                </div>

                <div class="card shadow problem">
                    <h2 class="title">Problem 2 - Multiplication Table</h2>
                    <h5 class="title">Generate a multiplication table using integers one and two below:</h5>
                    <form id="multiplication-table" class="card-body justify-content-center p-4 row"
                        action="lab08b.php" method="post" target="_blank">
                        <div class="form-group m-2 col ">
                            <label for="integer1">Num 1</label>
                            <input type="number" class="form-control" name="integer1" placeholder="ie. 3">
                        </div>
                        <div class="form-group m-2 col">
                            <label for="integer2">Num 2</label>
                            <input type="number" class="form-control" name="integer2" placeholder="ie. 12">
                        </div>
                        <div class="form-group m-2 col align-self-center">
                            <label></label>
                            <button style="width: 100%" type="submit" class="btn btn-success">Generate</button>
                        </div>
                    </form>
                </div>

                <div class="card shadow problem">
                    <h4 class="title">Image Attributions/Information</h4>
                    <div class="card-body">
                        <?php 
                        // Let user know what the halloween images can be/arttribute images used
                        echo "<h5 class='text-center'>Halloween Image is ".($display_halloween_image ? $halloween_image: "None. select one from ".json_encode($halloween_images))."</h5>";
                        $file = fopen("./images/attributions.txt", 'r');
                        $line = fgets($file);
                        while(! feof($file)) {
                            echo "<span class='text-muted'>".fgets($file)."</span><br />";
                        }
                        fclose($file);
                        ?>
                    </div>
                </div>
        </div>
    </div>
    <div class="shadow problem counter">
        <?php
            function generateCounterDigit($digit) {
                return "<span class='counter-digit'>{$digit}</span>";
            }
            if(isset($_COOKIE['numTimesVisited']))
            {
                $num_times_visited = $_COOKIE['numTimesVisited'];
                $num_times_visited += 1;
            } else { $num_times_visited = 1; }
            setcookie('numTimesVisited', $num_times_visited, 60 * 60 * 24 * 180 + time());
            $plural = $num_times_visited > 1 ? 's': '';
            echo "<h3 class='title'>You visited this site ";
            foreach( str_split((string)$num_times_visited) as $x => $digit){
                echo generateCounterDigit($digit);
                }
            echo " time{$plural}</h3>";
        ?>
    </div>
</body>

</html>