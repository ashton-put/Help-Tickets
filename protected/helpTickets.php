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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $choice = getPostData('radSelection');

    if ($choice == "All") {
        // query to fetch help ticket data
        $statement = $pdo->prepare("SELECT * FROM HelpTickets ORDER BY ticket_id DESC");
    } elseif ($choice == "Open") {
        // query to fetch help ticket data
        $statement = $pdo->prepare("SELECT * FROM HelpTickets WHERE completedYN = 0 ORDER BY ticket_id DESC");
    } elseif ($choice == "Closed") {
        // query to fetch help ticket data
        $statement = $pdo->prepare("SELECT * FROM HelpTickets WHERE completedYN = 1 ORDER BY ticket_id DESC");
    }

    $statement->execute();
    $tickets = $statement->fetchAll();
}

?>

<!-- main element -->
<main>
    <h2> Help Tickets </h2>
    <br>
    <section class="message">
    </section>
    <br>

    <!-- main page text -->
    <p>This page is for mentors to keep track of and respond to help tickets submitted by Hackathon participants.</p>
    <br>

    <!-- form to get the requested table data -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset class="radio">
            <legend>Choose: </legend>
            <p>
                <input type="radio" id="radAllTickets" name="radSelection" value="All" tabindex="400" required <?php 
                    if(isset($choice) && $choice == "All") echo 'checked'; ?>>
                <label class="radio-field" for="radAllTickets">All Tickets</label>
            </p>
            <p>
                <input type="radio" id="radOpenTickets" name="radSelection" value="Open" tabindex="405" required <?php 
                    if(isset($choice) && $choice == "Open") echo 'checked'; ?>>
                <label class="radio-field" for="radOpenTickets">Open Tickets</label>
            </p>
            <p>
                <input type="radio" id="radClosedTickets" name="radSelection" value="Closed" tabindex="410" required <?php 
                    if(isset($choice) && $choice == "Closed") echo 'checked'; ?>>
                <label class="radio-field" for="radClosedTickets">Closed Tickets</label>
            </p>
        </fieldset>

        <button class="button" type="submit">Submit</button>
    </form>

    <br>
    <h3><?php echo $choice ?> Help Tickets</h3>

    <table>
        <tr>
            <th>Ticket Number</th>
            <th>Time Submitted</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Team Name</th>
            <th>Room</th>
            <th>Question</th>
            <th>Completed (Y/N)</th>
            <th>Completed By</th>
        </tr>

        <!-- loop through and print the necessary info for each help ticket -->
        <?php foreach ($tickets as $ticket): ?>
            <tr>
                <td><?php echo $ticket['ticket_id']; ?></td>
                <td><?php echo $ticket['date']; ?></td>
                <td><?php echo $ticket['firstName']; ?></td>
                <td><?php echo $ticket['lastName']; ?></td>
                <td><?php echo $ticket['email']; ?></td>
                <td><?php echo $ticket['teamName']; ?></td>
                <td><?php echo $ticket['room']; ?></td>
                <td><?php echo $ticket['question']; ?></td>
                <td><?php echo $ticket['completedYN'] ? 'Yes' : 'No'; ?></td>
                <td><?php echo $ticket['completedBy']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
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