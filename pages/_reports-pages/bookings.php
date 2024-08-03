<?php
$sql = "SELECT DATE(booking_date) as date, COUNT(*) as total_bookings FROM bookings WHERE booking_date>=DATE_SUB(CURRENT_DATE, INTERVAL 10 DAY) GROUP BY DATE(booking_date) ORDER BY booking_date DESC";
$countSql = "SELECT COUNT(*) FROM bookings";
$result = $conn->query($sql);
$totalResult = $conn->query($countSql);
$bookingArr = [];
$total = 0;
$prevAmount = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookingArr[] = $row;
        $total += $row['total_bookings'];
    }
}
?>
<section class="reports">
    <div class="slots-graph">
    <div>
            <h3>Booking reports</h3>
            <div class="income-grid-table">
                <table>
                    <p>Last 10 days</p>
                    <tr>
                        <th>Date</th>
                        <th>No of bookings</th>
                        <th>Status</th>
                    </tr>
                    <?php foreach ($bookingArr as $booking): ?>
                        <tr>
                            <td><?= htmlspecialchars($booking['date']) ?></td>
                            <td><?= htmlspecialchars($booking['total_bookings']) ?></td>
                            <td><?php
                            if($prevAmount == 0) {
                                $percentage = 100;
                            }
                            else{
                                $percentage =number_format(abs(($booking['total_bookings'] - $prevAmount)) / $prevAmount * 100,1) ;
                            }
                            if ($booking['total_bookings'] > $prevAmount) { ?>
                                <div class="up">
                                    <div><img src="./assets/icons/icons8-up-52.png" alt="arrow" height="18" width="18"></div>
                                    <p><?php echo $percentage ?> % increased than previous</p>
                                </div>
                            <?php } else { ?>
                                <div class="up">
                                <img src="./assets/icons/icons8-down.png" alt="arrow" height="18" width="18">
                                <span><?php echo $percentage?> % decreased than previous</span>
                                </div>
                            <?php } ?>
                            </td>
                            <?php $prevAmount = $booking['total_bookings']; ?>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td style="font-weight: 700;">Total:</td>
                        <td style="font-weight: 700;"><?= $total ?></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="booking-details">
    <h3>Booking details</h3>
    <div class="filter-container">
        <form class="filter-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get"
            style="width:100%; border-radius:none; box-shadow:none; padding:0;margin:0; gap:2rem;">
            <input type="date" name="filterDate" style="width: 200px;" required>
            <button class="primary-btn" style="margin-left:2rem;"><i
                    class="fa-solid fa-filter"></i>&nbsp;Filter</button>
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
                    <td>
                        <?php if ($list['payment_status'] === 'pending') { ?>
                            <div class="action-container">
                                <form class="edit-form" action="./checkout-form.php">
                                    <input type="hidden" name="id" value="<?php echo $list['booking_id']; ?>">
                                    <button class="btn-success" style="font-size:1.5rem;">
                                        <i class="fa-regular fa-credit-card"></i>&nbsp;Checkout
                                    </button>
                                </form>
                            </div>
                        <?php } else { ?>
                            <div class="action-container">
                                <form class="edit-form" action="./invoice.php">
                                    <input type="hidden" name="id" value="<?php echo $list['booking_id']; ?>">
                                    <button class="btn-paid" style="font-size:1.5rem;">
                                        <i class="fa-solid fa-file-invoice"></i>&nbsp;See Invoice
                                    </button>
                                </form>
                            </div>
                        <?php } ?>
                    </td>
                    <td>
                        <div class="action-container">
                            <form class="edit-form" action="./editbookings.php">
                                <input type="hidden" name="id" value="<?php echo $list['booking_id'] ?>">
                                <button class="btn-success" style="font-size:1.5rem;"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                            </form>
                            <form class="delete-form" action="./proccess/deletebookings.php">
                                <input type="hidden" name="id" value="<?php echo $list['booking_id'] ?>">
                                <button class="btn-danger" style="font-size:1.5rem;"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>

                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>