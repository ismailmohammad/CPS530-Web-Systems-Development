<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./downloadedBootstrap.css" rel="stylesheet">
    <link href="./lab08.css" rel="stylesheet">
    <title>Lab 8 - PHP Multiplication Table</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
</head>
<body>
<?php
$integer_one = $_POST['integer1'];
$integer_two = $_POST['integer2'];
$input_error = FALSE;
function generateError($errorText) {
    global $input_error;
    $input_error = TRUE;
    return "<div class='alert alert-danger' role='alert'>Error: {$errorText}</div>";
}
function generateMultiplicationTable($numCols, $numRows) {
    $row_index = 1;
    echo "<table class='table table-striped table-dark table-hover'
    align=\"center\">";
    while ($row_index <= $numRows) {
        generateRow($numCols, $row_index);
        $row_index += 1;
    }
    echo "</table>";
}
function generateRow($colIndexMax, $rowMultiplier) {
    echo "<tr>";
    $colIndex = 1;
    while ( $colIndex <= $colIndexMax ) {
        echo "<td><h3>".$colIndex * $rowMultiplier."</h3></td>";
        $colIndex += 1;
        }
    echo "</tr>";
}
if (!$integer_one) echo generateError("Integer 1 not provided.");
if (!$integer_two) echo generateError("Integer 2 not provided.");
if ($integer_one > 12 || $integer_one < 3) echo generateError("Integer 1 must be between 3 and 12. You entered: ".$integer_one.".");
if ($integer_two > 12 || $integer_two < 3) echo generateError("Integer 2 must be between 3 and 12. You entered: ".$integer_two.".");
?>
 <div class="card shadow problem">
    <h2 class="title">Multiplication Table</h2>
    <div  class="card-body justify-content-center p-4 row">
    <?php
    if (!$input_error) {
        generateMultiplicationTable($integer_two, $integer_one);
    }
    ?>
    </div>
</div>
<button onclick="window.close();" style="width: 100%" type="button" class="btn btn-danger">Close Window</button>
</body>
</html>