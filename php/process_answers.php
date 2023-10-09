<?php
session_start();
?>
<?php include "header.php" ?>
<link rel="stylesheet" href="css/process_answers.css">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli = new mysqli("sql11.freemysqlhosting.net", "sql11649135", "YHHTfDSg5T", "sql11649135");

    if ($mysqli->connect_error) {
        die("Error: " . $mysqli->connect_error);
    }

    $sql = "INSERT INTO answ (`1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`, `21`, `22`, `23`, `24`, `25`, `26`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);

    foreach ($_POST['answers'] as $question => $answer) {
        $stmt->bind_param("ssss...", $answer, $answer, $answer, ..., $answer);
        $stmt->execute();
    }

    $stmt->close();
    $mysqli->close();

    echo "<h1>Selected Answers:</h1><ul>";

    foreach ($_POST['answers'] as $question => $answer) {
        $question = htmlspecialchars($question);
        $answer = htmlspecialchars($answer);

        echo "<li>Question: $question - Answer: $answer</li>";
    }

    echo "</ul>";
}
?>

<div class="container">
    <div class="column">
        <p><a href="page1.php">Назад</a></p>
    </div>

    <div class="column">
        <div class="wrapper">
            <div class="circle-out">
                <div id="bar" class="circle"></div>
                <span class="text" id="value">1</span>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>
