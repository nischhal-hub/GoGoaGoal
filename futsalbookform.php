<?php
require_once './includes/toppart.php';
function validateInput($data)
{
    return htmlspecialchars(trim($data));
}

$errormsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookersName = validateInput($_POST['bookersName']);
    $bookersContact = validateInput($_POST['contact']);
    $bookingDate = validateInput($_POST['date']);
    $bookingTime = validateInput($_POST['slot']);
    $paymentStatus = validateInput($_POST['payment']);

    if (empty($bookersName) || !preg_match("/^[A-Za-z\s]+$/", $bookersName)) {
        $errormsg .= "Invalid name";
    }
    if (empty($bookersContact) || !preg_match("/^\d{10}$/", $bookersContact)) {
        $errormsg .= "Invalid contact number";
    }
    if (empty($bookingDate)) {
        $errormsg .= "Booking date is required";
    }
    if (empty($bookingTime)) {
        $errormsg .= "Booking time slot is required";
    }
    if (empty($paymentStatus)) {
        $errormsg .= "Payment status is required";
    }
    

    $sql = "INSERT INTO bookings (initiator, initiator_contact, booking_date, booking_slot, payment_status) 
VALUES (?,?,?,?,?);
";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssss", $bookersName, $bookersContact, $bookingDate, $bookingTime, $paymentStatus);
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
                    <span class="close">&times;</span>
                    <p id="modal-message"><img src="./assets/icons/icons8-tick.gif" alt="tick gif">&nbsp;&nbsp;&nbsp;&nbsp;Futsal Booked
                        Successfully.</p>
                </div>
            </div>

            <form action="futsalbookform.php" method="post" id="itemIssueForm">
                <h3>Book Futsal</h3>
                <div>
                    <label for="name"><span>Bookers name:</span></label>
                    <input type="text" id="name" name="bookersName" pattern="^[A-Za-z\s]+$" placeholder="Hari Bahadur"
                        required>
                </div>
                <div>
                    <label for="contact">Contact:</label>
                    <input type="number" id="contact" name="contact" placeholder="9876543210" required>
                </div>
                <div>
                    <label for="bookingDate"><span>Booking Date:</span"></label>
                    <input type="date" name="date" id="bookingDate">
                </div>
                <div>
                    <label for="slot">Select Time Slot:</label>
                    <select id="slot" name="slot" required>
                        <option value="" disabled selected>Select Time</option>
                        <option value="6-7 AM">6:00-7:00 AM</option>
                        <option value="7-8 AM">7:00-8:00 AM</option>
                        <option value="8-9 AM">8:00-9:00 AM</option>
                        <option value="9-10 AM">9:00-10:00 AM</option>
                        <option value="10-11 AM">10:00-11:00 AM</option>
                        <option value="11-12 PM">11:00-12:00 PM</option>
                        <option value="12-1 PM">12:00-1:00 PM</option>
                        <option value="1-2 PM">1:00-2:00 PM</option>
                        <option value="2-3 PM">2:00-3:00 PM</option>
                        <option value="3-4 PM">3:00-4:00 PM</option>
                        <option value="4-5 PM">4:00-5:00 PM</option>
                        <option value="5-6 PM">5:00-6:00 PM</option>
                        <option value="6-7 PM">6:00-7:00 PM</option>
                    </select>
                </div>

                <div>
                    <label for="payment">Payment Method:</label>
                    <select id="payment" name="payment" required>
                        <option value="" disabled selected>Select Payment</option>
                        <option value="paid">Paid</option>
                        <option value="pending">Pending</option>
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
    document.addEventListener('DOMContentLoaded', function() {
        const errorMsg = '<?php echo $errormsg; ?>';
        if(errorMsg){
        const modal = document.getElementById('modal');
        const modalMessage = document.getElementById('modal-message');
        if(modal && modalMessage){
            modal.style.display = 'block';
            modalMessage.innerHTML = `<i class="fa-solid fa-circle-xmark fa-beat-fade fa-2xl" style="color: #e01b24; padding-right: 1rem;"></i> ${errorMsg}`;
        var closeBtn = document.getElementsByClassName('close')[0];
        closeBtn.onclick = function() {
            modal.style.display = 'none';
        }
        }
        
    }
    });
</script>

</html>