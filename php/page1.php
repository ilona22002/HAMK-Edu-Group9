<?php
session_start(); 
?>

<?php include "header.php" ?>
<?php
$title = "First page";
?>
<!DOCTYPE html>

<html lang="en">
 

<div class="container">
    <div class="column">
        <h2>Learnwell English (Project) (2)</h2>
      <form method="post" action="process_answers.php">

        <?php
        $servername = "sql11.freemysqlhosting.net";
        $username = "sql11649135";
        $password = "YHHTfDSg5T";
        $dbname = "sql11649135";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection error " . $conn->connect_error);
        }

        $conn->set_charset("utf8");

        $sql = "SELECT `COL 3` FROM `TABLE 3`"; 

        $result = $conn->query($sql);

        if ($result) {
            $questionCount = 0; 
            while ($row = $result->fetch_assoc()) {
                $questionCount++;
                echo "<fieldset>";
                echo "<legend>Question $questionCount:</legend>";
                echo "<div class='item'>";
                
                echo "<div class='column1'>"; 
                echo "<p class='line'>" . $row["COL 3"] . "</p>";
                echo "</div>";
                echo "<div class='column2'>"; 
                for ($i = 1; $i <= 5; $i++) {
                    $optionValue = $i; 
                    $inputName = 'answers[' . $questionCount . ']'; 
                    $inputId = 'scale' . $questionCount . '_' . $i; 
                    echo "<label for='$inputId'>$optionValue</label>";
                    echo "<input type='radio' name='$inputName' value='$optionValue' id='$inputId'>";
                }
                echo "</div>";
                echo "</div>";
                echo "</fieldset>";
            }
        } else {
            echo "Error " . $conn->error;
        }
        $conn->close();
        ?>
        <input type="submit" value="Submit">
        </form> 
    </div>
</div>

<?php include "footer.php" ?>

