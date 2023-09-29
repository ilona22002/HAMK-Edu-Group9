
<?php
$title = "First page";
include "header.php" ?>
<!DOCTYPE html>
<html lang="en">

<div class="container">
    <div class="column">
        <h2>Learnwell English</h2>
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

        $sql = "SELECT `question` FROM `TABLE 3`"; 

        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                $firstRowSkipped = false; 
                while ($row = $result->fetch_assoc()) {
                    if ($firstRowSkipped) { 
                        echo "<div class='item'>";
                        echo "<div class='column2'>"; 
                        for ($i = 1; $i <= 5; $i++) {
                            echo "<label for='scale".$row["question"]."_$i'></label>";
                            echo "<input type='radio' name='answer_".$row["question"]."' value='$i' id='scale".$row["question"]."_$i'>";
                        }
                        echo "</div>";
                        echo "<div class='column1'>"; 
                        echo "<p class='line'>" . $row["question"] . "</p>";
                        echo "</div>";
                        echo "</div>";
                    } else {
                        $firstRowSkipped = true;
                    }
                }
            } else {
                echo "No data";
            }
        } else {
            echo "Error " . $conn->error;
        }
        $conn->close();
        ?>



<?php include "footer.php" ?>