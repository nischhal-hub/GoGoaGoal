<?php
include './includes/toppart.php';
$bookingListSql = "SELECT * FROM bookings";
$summaryQueries = [
    "bookingSummarySql" => "SELECT COUNT(*) FROM bookings",
    "earningSummarySql" => "SELECT SUM(amount) FROM checkout",
    "expenditureSummarySql" => "SELECT SUM(exp_amount) FROM expenditure",
    "staffsSql" => "SELECT COUNT(*) FROM staff"
];
$resultArray = ["bookingSummarySql" => 0, "earningSummarySql" => 0, "expenditureSummarySql" => 0, "staffsSql" => 0];
foreach ($summaryQueries as $key => $query) {
    if ($result = $conn->query($query)) {
        $row = $result->fetch_assoc();
        $resultArray[$key] = reset($row);
    } else {
        echo 'Error:' . $conn->error . ".<br>";
    }
}

$result = $conn->query($bookingListSql);
$bookingsArr = [];
$i = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookingsArr[] = $row;
    }
}
?>

<div class="body-container">
    <div id="sidebar-space" class="sidebar-space"></div>
    <div class="container">

        <div class="summary">
            <h3>Lifetime Reports</h3>
            <div class="summary-container">
                <div class="box" style="margin-left: 0;">
                    <div class="result">
                        <p><?php echo $resultArray["bookingSummarySql"] ?></p>
                        <p>Total Bookings</p>
                    </div>
                    <div class="icon-container">
                        <i class="fa-brands fa-font-awesome fa-2xl" style="color: var(--primary)"></i>
                    </div>
                </div>
                <div class="box">
                    <div class="result">
                        <p><?php echo $resultArray["earningSummarySql"] == null ? '0' : $resultArray["earningSummarySql"] ?>
                        </p>
                        <p>Total Earning</p>
                    </div>
                    <div class="icon-container">
                        <i class="fa-solid fa-money-bills fa-2xl" style="color: var(--primary)"></i>
                    </div>
                </div>
                <div class="box">
                    <div class="result">
                        <p><?php echo $resultArray["expenditureSummarySql"] == null ? '0' : $resultArray["expenditureSummarySql"] ?>
                        </p>
                        <p>Total Expenditure</p>
                    </div>
                    <div class="icon-container">
                        <i class="fa-solid fa-file-invoice-dollar fa-2xl" style="color: var(--primary)"></i>
                    </div>
                </div>
                <div class="box" style="margin-right: 0;">
                    <div class="result">
                        <p><?php echo $resultArray["staffsSql"] ?></p>
                        <p>Total Staffs</p>
                    </div>
                    <div class="icon-container">
                        <i class="fa-solid fa-users fa-2xl" style="color:var(--primary)"></i>
                    </div>
                </div>
            </div>
        </div>

        <section class="reports">
            <div class="slots-graph">
                <div>
                    <h3>Booking reports</h3>
                    <div class="booking-grid-table">
                        <table>
                            <tr>
                                <th>Date</th>
                                <th>No of bookings</th>
                                <th>Status</th>
                            </tr>
                            <tr>
                                <td>2024/07/2</td>
                                <td>10</td>
                                <td><img src="./assets/icons/icons8-up-52.png" alt="arrow" height="18" width="18"></td>
                            </tr>
                            <tr>
                                <td>2024/07/2</td>
                                <td>10</td>
                                <td><img src="./assets/icons/icons8-down.png" alt="arrow" height="18" width="18"></td>
                            </tr>
                            <tr>
                                <td>2024/07/2</td>
                                <td>10</td>
                                <td><img src="./assets/icons/icons8-up-52.png" alt="arrow" height="18" width="18"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="income-graph">
                <div>
                    <h3>Income reports</h3>
                    <div class="income-grid-table">
                        <table>
                            <tr>
                                <th>Date</th>
                                <th>Income(in Rs)</th>
                                <th>Status</th>
                            </tr>
                            <tr>
                                <td>2024/07/2</td>
                                <td>1000</td>
                                <td><img src="./assets/icons/icons8-up-52.png" alt="arrow" height="18" width="18"></td>
                            </tr>
                            <tr>
                                <td>2024/07/2</td>
                                <td>5000</td>
                                <td><img src="./assets/icons/icons8-down.png" alt="arrow" height="18" width="18"></td>
                            </tr>
                            <tr>
                                <td>2024/07/2</td>
                                <td>6000</td>
                                <td><img src="./assets/icons/icons8-up-52.png" alt="arrow" height="18" width="18"></td>
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
                                        <i class="fa-solid fa-file-invoice"></i>&nbsp;Download Bill
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
                                        <button class="btn-danger" style="font-size:1.5rem;"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>

</div>
</main>
</body>

</html>