<?php
session_start();
?>
<?php include "header.php" ?>
<link rel="stylesheet" href="css/process_answers.css">

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

$sqlAvgFirst12 = "SELECT AVG((`1` + `2` + `3` + `4` + `5` + `6` + `7` + `8` + `9` + `10` + `11` + `12`) / 12) AS average_value FROM $tableName";
$stmtAvgFirst12 = $pdo->query($sqlAvgFirst12);
$averageResultFirst12 = $stmtAvgFirst12->fetch();
$averageValueFirst12 = number_format($averageResultFirst12['average_value'], 2);

$sqlAvg13to20 = "SELECT AVG((`13` + `14` + `15` + `16` + `17` + `18` + `19` + `20`) / 8) AS average_value FROM $tableName";
$stmtAvg13to20 = $pdo->query($sqlAvg13to20);
$averageResult13to20 = $stmtAvg13to20->fetch();
$averageValue13to20 = number_format($averageResult13to20['average_value'], 2);

$sqlAvg21 = "SELECT AVG(`21`) AS average_value FROM $tableName";
$stmtAvg21 = $pdo->query($sqlAvg21);
$averageResult21 = $stmtAvg21->fetch();
$averageValue21 = number_format($averageResult21['average_value'], 2);

$sqlAvg22to26 = "SELECT AVG((`22` + `23` + `24` + `25` + `26`) / 5) AS average_value FROM $tableName";
$stmtAvg22to26 = $pdo->query($sqlAvg22to26);
$averageResult22to26 = $stmtAvg22to26->fetch();
$averageValue22to26 = number_format($averageResult22to26['average_value'], 2);


$paramPlaceholders = implode(', ', array_fill(0, count($columnNames), '?'));

$sql = "INSERT INTO $tableName (" . implode(', ', $columnNames) . ") VALUES ($paramPlaceholders)";

$stmt = $pdo->prepare($sql);

$stmt->execute($selectedAnswers);
?>

<div class="container">
    <div class="column">
        <h1>Your avg:</h1>
    </div>
    <div class="column">
        <h1>Other avg:</h1>
    </div>
</div>

<div class="container">
    <h2>Approaches to learning</h2>
</div>

<div class="container">
    <div class="column">
        <div class="avg-container">
            <div class="wrapper">
                <div class="circle-out">
                    <div id="bar1" class="circle"></div>
                    <span class="text" id="value1"><?php echo number_format(array_sum(array_slice($selectedAnswers, 0, 12)) / 12, 2); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="column">
        <div class="avg-container">
            <div class="wrapper">
                <div class="circle-out">
                    <div id="bar1" class="circle"></div>
                    <span class="text" id="value1"><?php echo $averageValueFirst12; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>   


<div class="container">
    <div class="feedback">

        <?php
        $point = number_format(array_sum(array_slice($selectedAnswers, 0, 12)) / 12, 2);
        if ($point >= 4.5) {
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Approaches to learning' AND VALUE = 'Positive 1'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        } elseif ($point >= 3.5 && $point < 4.5) {
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Approaches to learning' AND VALUE = 'Positiv 2'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        } elseif ($point >= 2.5 && $point < 3.5){
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Approaches to learning' AND VALUE = 'Neutral 3'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        } elseif ($point >= 2 && $point < 2.5){
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Approaches to learning' AND VALUE = 'Negative 4'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        } elseif ($point < 2){
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Approaches to learning' AND VALUE = 'Negative 5'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        }        
        ?>
    </div>
</div>

<div class="container">
    <h2>Experiences of competence development</h2>
</div>

<div class="container">
    <div class="column">
        <div class="avg-container">
            <div class="wrapper">
                <div class="circle-out">
                    <div id="bar4" class="circle"></div>
                    <span class="text" id="value3"><?php echo number_format(array_sum(array_slice($selectedAnswers, 12, 8)) / 8, 2); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="column">
        <div class="avg-container">
            <div class="wrapper">
                <div class="circle-out">
                    <div id="bar4" class="circle"></div>
                    <span class="text" id="value3"><?php echo $averageValue13to20; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>        

<div class="container">
    <div class="feedback">

        <?php
        $point = number_format(array_sum(array_slice($selectedAnswers, 12, 8)) / 8, 2);
        if ($point >= 4.5) {
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Experiences of competence development' AND VALUE = 'Positive 1'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        } elseif ($point >= 3.5 && $point < 4.5) {
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Experiences of competence development' AND VALUE = 'Positiv 2'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        } elseif ($point >= 2.5 && $point < 3.5){
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Experiences of competence development' AND VALUE = 'Neutral 3'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        } elseif ($point >= 2 && $point < 2.5){
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Experiences of competence development' AND VALUE = 'Negative 4'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        } elseif ($point < 2){
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Experiences of competence development' AND VALUE = 'Negative 5'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        }        
        ?>
    </div>
</div>

<div class="container">
    <h2>Experiences of the learning environment</h2>
</div>

<div class="container">
    <div class="column">
        <div class="avg-container">
            <div class="wrapper">
                <div class="circle-out">
                    <div id="bar4" class="circle"></div>
                    <span class="text" id="value4"><?php echo number_format($selectedAnswers[20], 2); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="column">
        <div class="avg-container">
            <div class="wrapper">
                <div class="circle-out">
                    <div id="bar4" class="circle"></div>
                    <span class="text" id="value4"><?php echo $averageValue21; ?></span>
                </div>
            </div>
        </div>
    </div>
</div> 


<div class="container">
    <div class="feedback">

        <?php
        $point = number_format(array_sum(array_slice($selectedAnswers, 12, 8)) / 8, 2);
        if ($point >= 4.5) {
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Experiences of the learning development' AND VALUE = 'Positive 1'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        } elseif ($point >= 3.5 && $point < 4.5) {
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Experiences of the learning development' AND VALUE = 'Positiv 2'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        } elseif ($point >= 2.5 && $point < 3.5){
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Experiences of the learning development' AND VALUE = 'Neutral 3'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        } elseif ($point >= 2 && $point < 2.5){
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Experiences of the learning development' AND VALUE = 'Negative 4'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        } elseif ($point < 2){
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Experiences of the learning development' AND VALUE = 'Negative 5'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        }        
        ?>
    </div>
</div>

<div class="container">
    <h2>Self-efficacy</h2>
</div>

<div class="container">
    <div class="column">
        <div class="avg-container">
            <div class="wrapper">
                <div class="circle-out">
                    <div id="bar5" class="circle"></div>
                    <span class="text" id="value5"><?php echo number_format(array_sum(array_slice($selectedAnswers, 21, 5)) / 5, 2); ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="column">
        <div class="avg-container">
            <div class="wrapper">
                <div class="circle-out">
                    <div id="bar5" class="circle"></div>
                    <span class="text" id="value5"><?php echo $averageValue22to26; ?></span>
                </div>
            </div>
        </div>
    </div>
</div> 


<div class="container">
    <div class="feedback">

        <?php
        $point = number_format(array_sum(array_slice($selectedAnswers, 12, 8)) / 8, 2);
        if ($point >= 4.5) {
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Self-efficacy' AND VALUE = 'Positive 1'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        } elseif ($point >= 3.5 && $point < 4.5) {
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Self-efficacy' AND VALUE = 'Positiv 2'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        } elseif ($point >= 2.5 && $point < 3.5){
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Self-efficacy' AND VALUE = 'Neutral 3'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        } elseif ($point >= 2 && $point < 2.5){
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Self-efficacy' AND VALUE = 'Negative 4'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        } elseif ($point < 2){
            $sqlFeedback = "SELECT FEEDBACK FROM Feedbacks WHERE CATEGORY = 'Self-efficacy' AND VALUE = 'Negative 5'";
            $stmtFeedback = $pdo->query($sqlFeedback);
            if ($stmtFeedback) {
                while ($row = $stmtFeedback->fetch(PDO::FETCH_ASSOC)) {
                    echo $row["FEEDBACK"] . "<br>";
                }
            }
        }        
        ?>
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
