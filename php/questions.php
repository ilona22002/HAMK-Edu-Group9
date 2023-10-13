<?php
session_start();
?>

<?php include "header.php" ?>
<?php
$title = "First page";
?>

<div class="container">
    <div class="column">
        <h2>Learnwell English (Project)</h2>
        <h5 class="numbers" >1=Totally disagree <br>
            2=Disagree <br>
            3=In Between <br>
            4=Agree <br>
            5=Totally Agree</h5>
        <form method="post" action="process_answers.php" id="quizForm">

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

            $sql = "SELECT `question`, `subcategory`, `category` FROM `Questions` ORDER BY `category`, `subcategory`, `question_id`";

            $result = $conn->query($sql);

            if ($result) {
                $currentCategory = "";
                $questionCount = 0;
                $currentContainerStarted = false;

                while ($row = $result->fetch_assoc()) {
                    $questionCount++;
                    $category = $row["subcategory"];
                    $question = $row["question"];

                    if ($currentCategory !== $category) {
                        if ($currentContainerStarted) {
                            echo "</div>";
                            echo "<hr>";
                        }
 
                        echo "<h3>$category</h3>"; 
                        echo "<div class='item'>";
                        $currentCategory = $category;
                        $currentContainerStarted = true;
                    }

                    echo "<fieldset>";
                    echo "<legend>Question $questionCount:</legend>";
                    echo "<div class='column1'>";
                    echo "<p class='line'>" . $question . "</p>";
                    echo "</div>";
                    echo "<div class='column2'>";
                    for ($i = 1; $i <= 5; $i++) {
                        $optionValue = $i;
                        $inputName = 'answers[' . $questionCount . ']';
                        $inputId = 'scale' . $questionCount . '_' . $i;
                        echo "<label>";
                        echo "<input type='radio' name='$inputName' value='$optionValue' id='$inputId'>";
                        echo "<span>$optionValue</span>";
                        echo "</label>";
                    }
                    echo "</div>";
                    echo "</fieldset>";
                }

                if ($currentContainerStarted) {
                    echo "</div>";
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
<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("quizForm");
    const submitButton = form.querySelector("input[type=submit]");

    form.addEventListener("submit", function (event) {
        const radioInputs = form.querySelectorAll("input[type=radio]");
        let allAnswered = true;

        for (const radioInput of radioInputs) {
            const inputName = radioInput.name;
            const checkedInputs = form.querySelectorAll(`input[name="${inputName}"]:checked`);

            if (checkedInputs.length === 0) {
                allAnswered = false;
                break;
            }
        }

        if (!allAnswered) {
            alert("Please answer all questions before submitting the form.");
            event.preventDefault();
        }
    });
});
</script>
<?php include "footer.php" ?>
