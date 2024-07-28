<?php
include './includes/toppart.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $jointSql = 'SELECT 
    bookings.booking_id,
    bookings.initiator,
    bookings.initiator_contact,
    bookings.booking_date,
    bookings.booking_slot,
    bookings.payment_status,
    checkout.bottles_used,
    checkout.per_bottle_cost,
    checkout.amount,
    checkout.checkout_at
FROM 
    bookings
LEFT JOIN 
    checkout ON bookings.booking_id = checkout.booking_id
WHERE 
    bookings.booking_id = ?';
$stmt = $conn->prepare($jointSql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$result = $result->fetch_assoc();
}

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<div class="body-container">
    <div id="sidebar-space" class="sidebar-space"></div>
    <div class="container">
        <div style="margin-bottom: 2rem;">
            <button class="primary-btn"><a href="./index.php">Go back to home page.</a></button>
        </div>
        <div class="invoice-box" id="invoice">
            <table>
                <tr class="top">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td class="title" style="display:flex; justify-content: flex-start;">
                                    <img src="./assets/logo.png" style="width:60px;">
                                </td>
                                <td>
                                    Invoice #: <?php echo $result['booking_id']; ?><br>
                                    Created: <?php echo $result['checkout_at']; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="information">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td style="text-align:left;">
                                    Hello, <?php echo $result['initiator']; ?><br>
                                    Thank you for playing at our futsal.
                                </td>

                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="heading">
                    <td>Item Description</td>
                    <td>Item ID</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
                <tr class="item">
                    <td>Water bottles</td>
                    <td>HAILHYDRA</td>
                    <td><?php echo $result['bottles_used'];?></td>
                    <td><?php echo $result['bottles_used']*$result['per_bottle_cost']; ?></td>
                </tr>
                <tr class="item">
                    <td>Futsal Bookings</td>
                    <td>PLAYMYHRT</td>
                    <td>1</td>
                    <td><?php echo $result['amount']-($result['bottles_used']*$result['per_bottle_cost']);?></td>
                </tr>
                <tr class="total">
                    <td colspan="3"></td>
                    <td>Subtotal: Rs.<?php echo $result['amount']?> </td>
                </tr>
                <tr class="total">
                    <td colspan="3"></td>
                    <td>Total: Rs.<?php echo $result['amount']?></td>
                </tr>
                <tr class="information">
                    <td style="text-align:left;">
                        <strong>BILLING INFORMATION</strong><br>
                        <?php echo $result['initiator']; ?><br>
                        <?php echo $result['initiator_contact'];?><br>
                        
                    </td>
                    <td style="text-align:left;">
                        <strong>PAYMENT INFORMATION</strong><br>
                        Cash<br>
                    </td>
                </tr>
            </table>
        </div>
        <div class="download-container">
            <button id="download" class="primary-btn">Download Bill</button>
        </div>
    </div>
</div>
</main>
</body>
<script>
    document.getElementById('download').addEventListener('click', () => {
        const invoice = document.getElementById('invoice');
        const options = {
            margin: 0.5,
            filename: 'invoice.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        html2pdf().from(invoice).set(options).save();
    });
</script>

</html>