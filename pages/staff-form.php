<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staffName = $_POST['staffName'];
    $staffContact = $_POST['staffContact'];
    $staffEmail = $_POST['staffEmail'];
    $joinDate = $_POST['date'];

    // Check if the file key exists and there were no errors
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
        $avatar = file_get_contents($_FILES['avatar']['tmp_name']);

        // Prepare an insert statement
        $invoiceSql = "INSERT INTO staff (staff_name, staff_avatar, staff_contact, staff_email, staff_join_date) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($invoiceSql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $staffName, $avatar, $staffContact, $staffEmail, $joinDate);

            // Send the long data (avatar) to the prepared statement
            $stmt->send_long_data(1, $avatar);

            // Execute the prepared statement
            if ($stmt->execute()) {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var modal = document.getElementById('modal');
                    modal.style.display = 'block';
                    var closeBtn = document.getElementsByClassName('close')[0];
                    closeBtn.onclick = function() {
                        modal.style.display = 'none';
                    }
                });
                </script>";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement and connection
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "File upload error.";
    }

    $conn->close();
}
?>
<section>
    <div id="modal" class="modal show">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modal-message" style="text-align: center"><img src="./assets/icons/icons8-tick.gif"
                    alt="tick gif">&nbsp;&nbsp;&nbsp;&nbsp;Staff Added.🕺</p>
            <div>
                <button class="primary-btn"><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Add another
                        Staff</a></button>
                <button class="secondary-btn" style="color:black;"><a href="./staff.php">View Staff</a></button>
            </div>
        </div>
    </div>

    <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" id="itemIssueForm">
        <h3>Add staff</h3>
        <div>
            <label for="staffName"><span>Staff name:</span></label>
            <input type="text" id="staffName" name="staffName" pattern="^[A-Za-z\s]+$" placeholder="Bo'ohw'o'wo'er" required>
        </div>
        <div>
            <label for="avatar">Add your photo:</label>
            <input type="file" id="avatar" name="avatar" placeholder="2" required>
        </div>
        <div>
            <label for="expenseDate"><span>Join Date:</span"></label>
            <input type="date" name="date" id="joinedDate" required>
        </div>
        <div>
            <label for="staffContact"><span>Contact:</span></label>
            <input type="number" name="staffContact" id="staffContact" required>
        </div>
        <div>
            <label for="staffEmail"><span>Email:</span></label>
            <input type="email" name="staffEmail" id="staffEmail" required>
        </div>
        <div>
            <button class="secondary-btn" type="submit" id="myBtn" style="width: 100%;">Submit</button>
        </div>
    </form>

    <p style="text-align: center; font-size: 1.5rem;">Go back to home page.<a href="./index.php">Click here.</a>
    </p>
</section>
