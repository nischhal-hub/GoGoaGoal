<?php
require_once './includes/toppart.php';
function validateInput($data)
{
    return htmlspecialchars(trim($data));
}

$errormsg = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $sql = "SELECT * FROM bookings WHERE booking_id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    print_r($row);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $bookersName = validateInput($_POST['bookersName']);
    $bookersContact = validateInput($_POST['contact']);
    $bookingDate = validateInput($_POST['date']);
    $bookingTime = validateInput($_POST['slot']);
    $paymentStatus = validateInput($_POST['payment']);

    if (empty($bookersName) || !preg_match("/^[A-Za-z\s]+$/", $bookersName)) {
        $errormsg = "Invalid name";
    }
    if (empty($bookersContact) || !preg_match("/^\d{10}$/", $bookersContact)) {
        $errormsg = "Invalid contact number";
    }
    if (empty($bookingDate)) {
        $errormsg = "Booking date is required";
    }
    if (empty($bookingTime)) {
        $errormsg = "Booking time slot is required";
    }
    if (empty($paymentStatus)) {
        $errormsg = "Payment status is required";
    }


    $sql = "UPDATE bookings
SET initiator = ?,
    initiator_contact = ?,
    booking_date = ?,
    booking_slot = ?,
    payment_status = ?
WHERE booking_id = ?;
";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssi", $bookersName, $bookersContact, $bookingDate, $bookingTime, $paymentStatus, $id);
        if ($stmt->execute()) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                    var modal = document.getElementById('modal');
                    modal.style.display = 'block';
                    var closeBtn = document.getElementsByClassName('close')[0];
                        closeBtn.onclick = function() {
                            window.location.href = 'index.php';
                            modal.style.display = 'none';
                        }
            });
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

?>

<div class="body-container">
    <div id="sidebar-space" class="sidebar-space"></div>
    <div class="container">
        <section>

            <div id="modal" class="modal show">
                <div class="modal-content">
                    <span class="close" id="closeModal">&times;</span>
                    <p id="modal-message"><img src="./assets/icons/icons8-tick.gif"
                            alt="tick gif">&nbsp;&nbsp;&nbsp;&nbsp;Booking edited
                        Successfully.</p>
                </div>
            </div>

            <form class="form" action="editbookings.php" method="post" id="itemIssueForm">
                <h3>Edit Futsal Booking</h3>
                <input type="hidden" value="<?= $row['booking_id'] ?>" name="id">
                <div>
                    <label for="name"><span>Bookers name:</span></label>
                    <input type="text" id="name" name="bookersName" pattern="^[A-Za-z\s]+$"
                        value="<?= $row['initiator'] ?>" placeholder="Hari Bahadur" required>
                </div>
                <div>
                    <label for="contact">Contact:</label>
                    <input type="number" id="contact" name="contact" placeholder="9876543210"
                        value="<?= $row['initiator_contact'] ?>" required>
                </div>
                <div>
                    <label for="bookingDate"><span>Booking Date:</span"></label>
                    <input type="date" name="date" id="bookingDate" value="<?= $row['booking_date'] ?>">
                </div>
                <div>
                    <label for="slot">Select Time Slot:</label>
                    <?php
                    $timeArr = [
                        "6-7 AM" => "6:00-7:00 AM",
                        "7-8 AM" => "7:00-8:00 AM",
                        "8-9 AM" => "8:00-9:00 AM",
                        "9-10 AM" => "9:00-10:00 AM",
                        "10-11 AM" => "10:00-11:00 AM",
                        "11-12 PM" => "11:00-12:00 PM",
                        "12-1 PM" => "12:00-1:00 PM",
                        "1-2 PM" => "1:00-2:00 PM",
                        "2-3 PM" => "2:00-3:00 PM",
                        "3-4 PM" => "3:00-4:00 PM",
                        "4-5 PM" => "4:00-5:00 PM",
                        "5-6 PM" => "5:00-6:00 PM",
                        "6-7 PM" => "6:00-7:00 PM"
                    ];
                    ?>

                    <select id="slot" name="slot" required>
                        <option value="" disabled <?= empty($row['booking_slot']) ? 'selected' : '' ?>>Select Time
                        </option>
                        <?php foreach ($timeArr as $value => $display): ?>
                            <option value="<?= $value ?>" <?= $row['booking_slot'] == $value ? 'selected' : '' ?>>
                                <?= $display ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                </div>

                <div>
                    <label for="payment">Payment Method:</label>
                    <?php
                    $paymentArr = [
                        "paid" => "Paid",
                        "pending" => "Pending"
                    ];
                    ?>

                    <select id="payment" name="payment" required>
                        <option value="" disabled <?= empty($row['payment_status']) ? 'selected' : '' ?>>Select Payment
                        </option>
                        <?php foreach ($paymentArr as $value => $display): ?>
                            <option value="<?= $value ?>" <?= $row['payment_status'] == $value ? 'selected' : '' ?>>
                                <?= $display ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <div>
                    <button class="secondary-btn" type="submit" id="myBtn" style="width: 100%;">Submit</button>
                </div>
            </form>

            <p style="text-align: center; font-size: 1.5rem;">Go back to home page.<a href="./index.php">Click here.</a>
            </p>
        </section>
    </div>

</div>

</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const errorMsg = '<?php echo $errormsg; ?>';
        if (errorMsg) {
            const modal = document.getElementById('modal');
            const modalMessage = document.getElementById('modal-message');
            if (modal && modalMessage) {
                modal.style.display = 'block';
                modalMessage.innerHTML = `<i class="fa-solid fa-circle-xmark fa-beat-fade fa-2xl" style="color: #e01b24; padding-right: 1rem;"></i> ${errorMsg}`;
                var closeBtn = document.getElementsByClassName('close')[0];
                closeBtn.onclick = function () {
                    modal.style.display = 'none';
                }
            }

        }
    });
</script>

</html>