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
?>

<div class="container">
    <div class="column">
    <p>Среднее арифметическое для первых 12 столбцов: <?php echo $averageValueFirst12; ?></p>
    <p>Среднее арифметическое для столбцов с 13 по 20: <?php echo $averageValue13to20; ?></p>
    <div class="avg-container">
            <h2>From 22 to 26:</h2>
            <div class="wrapper">
                <div class="circle-out">
                    <div id="bar5" class="circle"></div>
                    <span class="text" id="value5"><?php echo $averageValue13to20; ?></span>
                </div>
            </div>
        </div>
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
