<?php
include 'top.php';

$dataIsGood = false;
$message = '';

// Data from user submitting ticket
$firstName = ''; // text input
$lastName = ''; // text input
$email = ''; // text input
$teamName = ''; // text input

$room = "E102"; // radio button

$question = ''; // text input

// Function to sanitize the data
function getData($field) {
    if (!isset($_POST[$field])) {
        $data = "";
    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data);
    }
    return $data;
}

function verifyAlphaNum($testString) {
    // Check for letters, numbers and dash, period, space and single quote only.
    // added & ; and # as a single quote sanitized with html entities will have 
    // this in it bob's will become bob's
    return (preg_match ("/^([[:alnum:]]|-| |\'|&|;|#)+$/", $testString));
}

?>

    <main class="form">
        <h2>Submit a Help Ticket</h2>
        <br>
        <section class="message">
            <?php
                print $message
            ?>
        </section>
        <br>
        
        <section>
            <?php
            if($_SERVER["REQUEST_METHOD"] == 'POST'){
                
                // Sanitize the Data
                $firstName = getData('txtFirstName');
                $lastName = getData('txtLastName');
                $email = getData('txtEmail');
                $teamName = getData('txtTeamName');

                $room = getData('radRoom');

                $question = getData('txtQuestion');

                // Validate the data
                $dataIsGood = true;
                
                if($firstName == ''){
                    print '<p class="mistake">Please type in your first name.</p>';
                    $dataIsGood = false;
                } elseif(!verifyAlphaNum($firstName)){
                    print '<p class="mistake">Your first name contains extra characters that are not allowed. Use only letters, numbers, hyphen, and a space.</p>';
                    $dataIsGood = false;
                }
                
                if($lastName == ''){
                    print '<p class="mistake">Please type in your last name.</p>';
                    $dataIsGood = false;
                } elseif(!verifyAlphaNum($lastName)){
                    print '<p class="mistake">Your last name contains extra characters that are not allowed. Use only letters, numbers, hyphen, and a space.</p>';
                    $dataIsGood = false;
                }
                
                if($email == ''){
                    print '<p class="mistake">Please type in your email address.</p>';
                    $dataIsGood = false;
                } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    print '<p class="mistake">Your email address contains invalid characters.</p>';
                    $dataIsGood = false;
                }

                if($teamName == ''){
                    print '<p class="mistake">Please type in your team name.</p>';
                    $dataIsGood = false;
                } elseif(!verifyAlphaNum($teamName)){
                    print '<p class="mistake">Your team name contains extra characters that are not allowed. Use only letters, numbers, hyphen, and a space.</p>';
                    $dataIsGood = false;
                }

                // CHECK WHICH ROOMS WE HAVE BOOKED
                if ($room != 'E102' AND $room != 'E210' AND $room != 'E204'){
                    print '<p class="mistake">Please indicate which room you are in.</p>';
                    $dataIsGood = false;
                }
                
                if($question == ''){
                    print '<p class="mistake">Please type in your question</p>';
                    $dataIsGood = false;
                } elseif(!verifyAlphaNum($question)){
                    print '<p class="mistake">Your question contains invalid characters.</p>';
                    $dataIsGood = false;
                }

                // Save the data
                if($dataIsGood){
                    try{
                        $sql = 'INSERT INTO HelpTickets (firstName, lastName, email, teamName, room, question, completedYN, completedBy) 
                        VALUES (?, ?, ?, ?, ?, ?, 0, "uncompleted")';
                        
                        $statement = $pdo->prepare($sql);
                        $data = array($firstName, $lastName, $email, $teamName, $room, $question);

                        if($statement->execute($data)){
                            $message = '<h2>Thank you for the submission!</h2><p>Your help ticket will be addressed soon!</p>';
                        } else {
                            $message = '<p>Issue submitting your help ticket. Please try again.</p>';
                        }

                    } catch(PDOException $e){
                        $message = '<p>Could not insert the record, please contact the system administrator</p>';
                    }
                } // data is good
            } // end submitting line

            ?>

        </section>
    
        <section>
            <h3>Enter Your Information Below:</h3>
            <br>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">


            <!-- PERSONAL INFO STUFF -->
            <fieldset class="contact">
                <legend>Your Name and Team Name:</legend>
                <p>
                    <label class="required" for="txtFirstName">First Name:</label>
                    <input id="txtFirstName" maxlength="50" name="txtFirstName" onfocus="this.select()" tabindex="300" type="text" value="<?php print $firstName; ?>" required>
                </p>
                <p>
                    <label class="required" for="txtLastName">Last Name:</label>
                    <input id="txtLastName" maxlength="50" name="txtLastName" onfocus="this.select()" tabindex="305" type="text" value="<?php print $lastName; ?>" required>
                </p>
                <p>
                    <label class="required" for="txtEmail">Email:</label>
                    <input id="txtEmail" maxlength="50" name="txtEmail" onfocus="this.select()" tabindex="310" type="email" value="<?php print $email; ?>" required>
                </p>
                <p>
                    <label class="required" for="txtTeamName">Team Name:</label>
                    <input id="txtTeamName" maxlength="50" name="txtTeamName" onfocus="this.select()" tabindex="315" type="text" value="<?php print $teamName; ?>" required>
                </p>
            </fieldset>
    

            <!-- RADIO BUTTON STUFF -->
            <fieldset class="radio">
                <legend>Which room are you in?</legend>
                <p>
                    <input type="radio" id="radE102" name="radRoom" value="E102" tabindex="400" required <?php 
                        if($room == "E102") print 'checked'; ?> >
                    <label class="radio-field" for="radE102">E102</label>
                </p>
                <p>
                    <input type="radio" id="radE210" name="radRoom" value="E210" tabindex="405" required <?php 
                        if($room == "E210") print 'checked'; ?> >
                    <label class="radio-field" for="radE210">E210</label>
                </p>
                <p>
                    <input type="radio" id="radE204" name="radRoom" value="E204" tabindex="410" required <?php 
                        if($room == "E204") print 'checked'; ?> >
                    <label class="radio-field" for="radE204">E204</label>
                </p>

                <!-- ADD RADIO BUTTONS FOR OTHER ROOMS HERE -->
                
            </fieldset>

            <!-- TEXTBOX STUFF -->
            <fieldset class="text">
                <legend>Describe the Issue:</legend>
                <p>
                    <label for="txtQuestion"></label>
                    <textarea id="txtQuestion" name="txtQuestion" placeholder="The issue is..." rows="5" cols="30" tabindex="650"><?php print $question;?></textarea>
                </p>
            </fieldset>


            <!-- SUBMIT BUTTON STUFF -->
            <fieldset class="buttons">
                <input class="button" id="btnSubmit" name="btnSubmit" type="submit" value="Submit" tabindex="750">
            </fieldset>
            </form>
        </section>
        <br>

        <section class="message">
            <?php
                print $message
            ?>
        </section>
    
    </main>
<?php
include 'footer.php';
?>