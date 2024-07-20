<?php
$bookingListSql = "SELECT * FROM bookings WHERE payment_status = 'pending'";
$result = $conn->query($bookingListSql);
$bookingsArr = [];
$i = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookingsArr[] = $row;
    }
}

?>
<div class="booking-details">
        <h3>Booking details</h3>
        <div class="filter-container">
            <form class="filter-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get"
                style="width:100%; border-radius:none; box-shadow:none; padding:0;margin:0; gap:2rem;">
                <input type="text" name="search" style="width: 200px;" placeholder="Search.." required>
                <button class="primary-btn" style="margin-left:2rem;"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;Search</button>
            </form>
        </div>
        <table class="booking-details-table">
            <tr>
                <th>S.N</th>
                <th>Booking initiator</th>
                <th>Contact</th>
                <th>Booked Date</th>
                <th>Booked time</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>
            <?php if (empty($bookingsArr)): ?>
                <tr>
                    <td colspan="6" style="text-align: center; font-size: 2rem;">No data to show</td>
                </tr>
            <?php else: ?>
                <?php foreach ($bookingsArr as $list): ?>
                    <?php $i++; ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $list['initiator'] ?></td>
                        <td><?= $list['initiator_contact'] ?></td>
                        <td><?= $list['booking_date'] ?></td>
                        <td><?= $list['booking_slot'] ?></td>
                        <td><?= $list['payment_status'] ?></td>
                        <td>
                            <div class="action-container">
                                <form class="edit-form" action="./checkout-form.php">
                                <input type="hidden" name="id" value="<?php echo $list['booking_id'] ?>">
                                <button class="btn-success" style="font-size:1.5rem;"><i class="fa-regular fa-credit-card"></i>&nbsp;Checkout</button>
                                </form>
                            </div>

                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>