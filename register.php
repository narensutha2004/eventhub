<?php
/*
 * register.php - The registration form
 * Member 4: [Name] - Registration form
 * The form sends its data to save_registration.php (method POST).
 */

require 'includes/db.php';

// Events for the dropdown
$result = mysqli_query($conn, "SELECT id, title FROM events ORDER BY event_date");

// If the user clicked "Register" on an event card, pre-select that event
$selectedEvent = isset($_GET['event']) ? (int)$_GET['event'] : 0;

// Error message sent back by save_registration.php
$error = isset($_GET['error']) ? $_GET['error'] : "";

$pageTitle = "Register";
include 'includes/header.php';
?>

<section class="form-section">
    <h1>Register for an Event</h1>
    <p>Fill in your details. All fields are required.</p>

    <?php if ($error != "") { ?>
        <p class="message error"><?php echo htmlspecialchars($error); ?></p>
    <?php } ?>

    <form id="registerForm" action="save_registration.php" method="POST" novalidate>

        <label for="event_id">Event</label>
        <select id="event_id" name="event_id">
            <option value="">-- Choose an event --</option>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $selectedEvent) echo "selected"; ?>>
                    <?php echo htmlspecialchars($row['title']); ?>
                </option>
            <?php } ?>
        </select>

        <label for="student_name">Full Name</label>
        <input type="text" id="student_name" name="student_name" maxlength="100">

        <label for="student_id">Student ID</label>
        <input type="text" id="student_id" name="student_id" maxlength="20" placeholder="e.g. IT23001234">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" maxlength="100">

        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" maxlength="10" placeholder="10 digits, e.g. 0771234567">

        <p id="formError" class="message error" hidden></p>

        <button type="submit" class="btn">Submit Registration</button>
    </form>
</section>

<?php
mysqli_close($conn);
include 'includes/footer.php';
?>
