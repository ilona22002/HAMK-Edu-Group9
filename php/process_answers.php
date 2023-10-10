<?php
session_start();
?>
<?php include "header.php" ?>
<link rel="stylesheet" href="css/process_answers.css">
<script src="script.js"></script>

<?php
$selectedAnswers = []; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['answers'] as $answer) {
        $selectedAnswers[] = htmlspecialchars($answer); 
    }
}

$pdo = new PDO("mysql:host=sql11.freemysqlhosting.net;dbname=sql11649135", "sql11649135", "YHHTfDSg5T");

$tableName = "answ";
$columnNames = ["`1`", "`2`", "`3`", "`4`", "`5`", "`6`", "`7`", "`8`", "`9`", "`10`", "`11`", "`12`", "`13`", "`14`", "`15`", "`16`", "`17`", "`18`", "`19`", "`20`", "`21`", "`22`", "`23`", "`24`", "`25`", "`26`"];

$paramPlaceholders = implode(', ', array_fill(0, count($columnNames), '?'));

$sql = "INSERT INTO $tableName (" . implode(', ', $columnNames) . ") VALUES ($paramPlaceholders)";

$stmt = $pdo->prepare($sql);

$stmt->execute($selectedAnswers);
?>

<div class="container">
    <div class="column">
        <p><a href="page1.php">back</a></p>
        <h1>Your avg:</h1>
        <div class="avg-container">
            <h2>From 1 to 12:</h2>
            <div class="wrapper">
            <div class="circle-out">
                <div id="bar1" class="circle"></div>
                <span class="text" id="value1"><?php echo number_format(array_sum(array_slice($selectedAnswers, 0, 12)) / 12, 2); ?></span>
            </div>
        </div>
        </div>
    </div>

    <div class="column">
        
    </div>
</div>

<div class="container">
    <div class="column">
        <div class="avg-container">
            <h2>13:</h2>
            <div class="wrapper">
            <div class="circle-out">
                <div id="bar2" class="circle"></div>
                <span class="text" id="value2"><?php echo $selectedAnswers[12]; ?></span>
            </div>
        </div>
        </div>
    </div>

    <div class="column">
        
    </div>
</div>

<div class="container">
    <div class="column">
        <div class="avg-container">
            <h2>From 14 to 21:</h2>
            <div class="wrapper">
            <div class="circle-out">
                <div id="bar3" class="circle"></div>
                <span class="text" id="value3"><?php echo number_format(array_sum(array_slice($selectedAnswers, 13, 8)) / 8, 2); ?></span>
            </div>
        </div>
        </div>
    </div>

    <div class="column">
        
    </div>
</div>

<div class="container">
    <div class="column">
        <div class="avg-container">
            <h2>From 22 to 26:</h2>
            <p><?php echo number_format(array_sum(array_slice($selectedAnswers, 21, 5)) / 5, 2); ?></p>
            <div class="wrapper">
            <div class="circle-out">
                <div id="bar4" class="circle"></div>
                <span class="text" id="value4"><?php echo number_format(array_sum(array_slice($selectedAnswers, 21, 5)) / 5, 2); ?></span>
            </div>
        </div>
        </div>
    </div>

    <div class="column">
        
    </div>
</div>

<?php include "footer.php" ?>

<script>
const bars = document.querySelectorAll(".circle");
const valueTexts = document.querySelectorAll(".text");

for (let i = 0; i < bars.length; i++) {
    const bar = bars[i];
    const valueText = valueTexts[i];
    
    if (bar && valueText) {
        console.log();

        function setProgress() {
            const value = parseFloat(valueText.textContent);

            const p = 180 - ((value - 1) / 4) * 180;

            bar.style.transform = `rotate(-${p}deg)`;
        }

        setProgress();
    }
}
</script>
