<?php include "header.php" ?>
<?php
$title = "First page";?>
<!DOCTYPE html>
<html lang="en">
 

<body>
   
     
</main>
</body>
    
    

<div class="container">
    <div class="column">
        <h2>Learnwell English (Project) (2)</h2>
        <?php
        $servername = "sql11.freemysqlhosting.net";
        $username = "sql11646400";
        $password = "te3DQQPTlD";
        $dbname = "sql11646400";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection error " . $conn->connect_error);
        }

        $conn->set_charset("utf8");

        $sql = "SELECT `COL 3` FROM `TABLE 1`"; 

        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                $firstRowSkipped = false; 
                while ($row = $result->fetch_assoc()) {
                    if ($firstRowSkipped) { 
                        echo "<div class='item'>";
                        echo "<div class='column2'>"; 
                        for ($i = 1; $i <= 5; $i++) {
                            echo "<label for='scale".$row["COL 3"]."_$i'></label>";
                            echo "<input type='radio' name='answer_".$row["COL 3"]."' value='$i' id='scale".$row["COL 3"]."_$i'>";
                        }
                        echo "</div>";
                        echo "<div class='column1'>"; 
                        echo "<p class='line'>" . $row["COL 3"] . "</p>";
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