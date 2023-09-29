<?php
session_start();

$servername = "sql11.freemysqlhosting.net";
$username = "sql11649135";
$password = "YHHTfDSg5T";
$dbname = "sql11649135";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection error " . $conn->connect_error);
}

$conn->set_charset("utf8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sums = array();
    $counts = array();

    foreach ($_POST['answers'] as $question => $answer) {
        $question = mysqli_real_escape_string($conn, $question);
        $answer = mysqli_real_escape_string($conn, $answer);

        $group = ceil($question / 5); 

        if (!isset($sums[$group])) {
            $sums[$group] = 0;
            $counts[$group] = 0;
        }
        $sums[$group] += $answer;
        $counts[$group]++;
    }

    echo "<h1>Average:</h1>";
    echo "<ul>";

    foreach ($sums as $group => $sum) {
        $average = $sum / $counts[$group];
        echo "<li>Average " . (($group - 1) * 5 + 1) . " - " . ($group * 5) . ": $average</li>";
    }

    echo "</ul>";
}
?>

<p><a href="page1.php">Назад</a></p>

<?php include "footer.php" ?>
