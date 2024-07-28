<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM staff WHERE staff_id=?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "No ID provided.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $staffName = $_POST['staffName'];
        $staffContact = $_POST['staffContact'];
        $staffEmail = $_POST['staffEmail'];
        $joinDate = $_POST['date'];

        $avatar = null;
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
            $avatar = file_get_contents($_FILES['avatar']['tmp_name']);
        }

        $updateSql = "UPDATE staff SET staff_name = ?, staff_avatar = ?, staff_contact = ?, staff_email = ?, staff_join_date = ? WHERE staff_id = ?";
        if ($stmt = $conn->prepare($updateSql)) {
            $stmt->bind_param("sssssi", $staffName, $avatar, $staffContact, $staffEmail, $joinDate, $id);
            if ($avatar !== null) {
                $stmt->send_long_data(1, $avatar);
            }

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

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "No ID provided.";
    }

    $conn->close();
}
?>
<section>
    <div id="modal" class="modal show">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modal-message" style="text-align: center"><img src="./assets/icons/icons8-tick.gif"
                    alt="tick gif">&nbsp;&nbsp;&nbsp;&nbsp;Staff Edited.🕺</p>
            <div>
                <button class="secondary-btn" style="color:black;"><a href="./staff.php">View Staff</a></button>
            </div>
        </div>
    </div>

    <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" id="itemIssueForm">
        <h3>Edit staff</h3>
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
        <div>
            <label for="staffName"><span>Staff name:</span></label>
            <input type="text" id="staffName" name="staffName" value="<?php echo htmlspecialchars($row['staff_name']); ?>" pattern="^[A-Za-z\s]+$" placeholder="Bo'ohw'o'wo'er" required>
        </div>
        <div>
            <label for="avatar">Add your photo:</label>
            <input type="file" id="avatar" name="avatar">
        </div>
        <div>
            <label for="expenseDate"><span>Join Date:</span></label>
            <input type="date" name="date" value="<?php echo htmlspecialchars($row['staff_join_date']); ?>" id="joinedDate" required>
        </div>
        <div>
            <label for="staffContact"><span>Contact:</span></label>
            <input type="number" name="staffContact" value="<?php echo htmlspecialchars($row['staff_contact']); ?>" id="staffContact" required>
        </div>
        <div>
            <label for="staffEmail"><span>Email:</span></label>
            <input type="email" name="staffEmail" value="<?php echo htmlspecialchars($row['staff_email']); ?>" id="staffEmail" required>
        </div>
        <div>
            <button class="secondary-btn" type="submit" id="myBtn" style="width: 100%;">Edit</button>
        </div>
    </form>

    <p style="text-align: center; font-size: 1.5rem;">Go back to home page.<a href="./index.php">Click here.</a>
    </p>
</section>
