<?php
include './includes/toppart.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $sql = "SELECT * FROM bookings WHERE booking_id=$id AND payment_status = 'pending';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $bottles = $_POST['bottle'];
    $rate = $_POST['rate'];
    $amount = ($bottles * 25) + $rate;
    $sql = "UPDATE bookings SET payment_status = 'paid' WHERE booking_id = $id";
    $invoiceSql = "INSERT INTO checkout (bottles_used, amount, booking_id)
                    VALUES (?, ?, ?);";
    if ($stmt = $conn->prepare($invoiceSql)) {
        $stmt->bind_param("iii", $bottles, $amount, $id);
        if ($stmt->execute()) {
            $result = $conn->query($sql);
            header("Location: invoice.php?id=" . $id);
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
    }
}
?>

<div class="body-container">
    <div id="sidebar-space" class="sidebar-space"></div>
    <div class="container">
        <section>

            <div id="modal" class="modal show">
                <div class="modal-content">
                    <p id="modal-message"><img src="./assets/icons/icons8-tick.gif"
                            alt="tick gif">&nbsp;&nbsp;&nbsp;&nbsp;Checkout Successfull.</p>
                </div>
            </div>

            <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="itemIssueForm">
                <h3>Checkout</h3>
                <div>
                    <label for="name"><span>Bookers name:</span></label>
                    <input type="text" id="name" name="bookersName" value="<?php echo $row['initiator']; ?>"
                        pattern="^[A-Za-z\s]+$" placeholder="Hari Bahadur" disabled>
                </div>
                <div>
                    <label for="contact">Time slot:</label>
                    <input type="text" id="contact" name="contact" value="<?php echo $row['booking_slot']; ?>" disabled>
                </div>
                <div>
                    <label for="bookingDate"><span>Booking Date:</span"></label>
                    <input type="date" name="date" id="bookingDate" value="<?php echo $row['booking_date']; ?>"
                        disabled>
                </div>
                <div class="checkout-group">
                    <div style="width: 48%;">
                        <label for="bottles"><span>Water bottle's used:</span></label>
                        <input type="number" name="bottle" id="bottles" value="0" required>
                    </div>
                    <div style="width: 48%;">
                        <label for="hourlyRate"><span>Hourly rate (in Rs):</span></label>
                        <input type="number" name="rate" id="hourlyRate" value="1000" required>
                    </div>
                    <div>
                        <input type="hidden" value="<?php echo $row['booking_id']; ?>" name="id">
                    </div>
                </div>
                <div class="checkout-total" id="checkout-total">
                    <h3 style="text-align:left;">Total:</h3>
                    <h2 id="total"></h2>
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
</main>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const bottlesInput = document.getElementById('bottles');
        const hourlyRateInput = document.getElementById('hourlyRate');
        const totalElement = document.getElementById('total');

        function updateTotal() {
            const bottles = parseFloat(bottlesInput.value) || 0;
            const hourlyRate = parseFloat(hourlyRateInput.value) || 0;
            const total = (bottles*25) + hourlyRate;
            totalElement.textContent = `Rs. ${total}`;
        }

        bottlesInput.addEventListener('input', updateTotal);
        hourlyRateInput.addEventListener('input', updateTotal);

        updateTotal();
    });
</script>

</html>