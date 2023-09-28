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
    echo "<h1>answers:</h1>";
    echo "<ul>";

    foreach ($_POST['answers'] as $question => $answer) {
        $question = mysqli_real_escape_string($conn, $question);
        $answer = mysqli_real_escape_string($conn, $answer);

        echo "<li>question $question: $answer</li>";
    }

    echo "</ul>";
}
?>



<p><a href="page1.php">back</a></p>

<?php include "footer.php" ?>
