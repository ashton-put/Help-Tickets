<?php
include 'top.php';

// start the session to remember the user
session_start();

// function to get POST data
function getPostData($field) {
    if (!isset($_POST[$field])) {
        $data = '';
    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data);
    }
    return $data;
}

// function to verify if a string contains only allowed characters
function verifyAlphaNum($testString) {
    // check for letters, numbers, dash, period, space, single quote, ampersand, semicolon, and hash only.
    return (preg_match ("/^([[:alnum:]]|-| |\'|&|;|#)+$/", $testString));
}

// if the request method is POST
// Initializing variables
$message = '';
$ticketId = '';
$completedBy = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticketId = getPostData("txtTicketNum");
    $completedBy = getPostData("txtMentorName");

    $dataIsGood = true;

    if ($ticketId == '') {
        $message .= '<p class="mistake">Please input ticket number.</p>';
        $dataIsGood = false;
    } elseif (!verifyAlphaNum($ticketId)) {
        $message .= '<p class="mistake">Your ticket number contains extra characters that are not allowed. Use only letters, numbers, hyphen, and a space.</p>';
        $dataIsGood = false;
    }

    if ($completedBy == '') {
        $message .= '<p class="mistake">Please type in your name.</p>';
        $dataIsGood = false;
    } elseif (!verifyAlphaNum($completedBy)) {
        $message .= '<p class="mistake">Your name contains extra characters that are not allowed. Use only letters, numbers, hyphen, and a space.</p>';
        $dataIsGood = false;
    }

    // Validate ticket ID and completedBy field
    if ($dataIsGood) {
        try {
            // Update the database to mark the ticket as completed
            $sql = "UPDATE HelpTickets SET completedYN = 1, completedBy = ? WHERE ticket_id = ?";
            $statement = $pdo->prepare($sql);
            $statement->execute([$completedBy, $ticketId]);
            $message = "<p>Help ticket marked as completed successfully!</p>";
        } catch (PDOException $e) {
            // Handle database errors
            $message = "<p>Could not insert the record, please contact the system administrator</p>";
        }
    }
}

?>

<!-- main element -->
<main>
    <h2>Mark as Completed</h2>
    <br>
    <section class="message">
    </section>
    <br>

    <!-- main page text -->
    <p>This page is for mentors to mark help tickets as completed.</p>
    <br>

    <!-- form to get the requested table data -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset>
            <legend>Mark a ticket as complete:</legend>
            <p>
                <label class="required" for="txtTicketNum">Ticket Number:</label>
                <input id="txtTicketNum" maxlength="3" name="txtTicketNum" onfocus="this.select()" tabindex="400" type="text" value="<?php print $ticketId; ?>" required>
            </p>
            <p>
                <label class="required" for="txtMentorName">Mentor Name:</label>
                <input id="txtMentorName" maxlength="50" name="txtMentorName" onfocus="this.select()" tabindex="405" type="text" value="<?php print $completedBy; ?>" required>
            </p>
        </fieldset>

        <button class="button" type="submit">Submit</button>
    </form>
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