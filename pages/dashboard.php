<?php
$bookingListSql = "SELECT * FROM bookings";
$summaryQueries = [
    "bookingSummarySql" => "SELECT COUNT(*) FROM bookings",
    "earningSummarySql" => "SELECT SUM(amount) FROM checkout",
    "expenditureSummarySql" => "SELECT SUM(exp_amount) FROM expenditure",
    "staffsSql" => "SELECT COUNT(*) FROM staff"
];
$currentDate = date("Y-m-d");
$bookedSlotQuery = "SELECT * FROM bookings WHERE booking_date = '$currentDate' ";

// FOR FETCHING BOOKING LIST
$result = $conn->query($bookingListSql);
$bookingsArr = [];
$i = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookingsArr[] = $row;
    }
}

//FOR FETCHING SUMMARY LIST
$resultArray = ["bookingSummarySql" => 0, "earningSummarySql" => 0, "expenditureSummarySql" => 0, "staffsSql" => 0];
foreach ($summaryQueries as $key => $query) {
    if ($result = $conn->query($query)) {
        $row = $result->fetch_assoc();
        $resultArray[$key] = reset($row);
    } else {
        echo 'Error:' . $conn->error . ".<br>";
    }
}

// FOR FETCHING BOOKED SLOTS
$result = $conn->query($bookedSlotQuery);
$bookings = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}
$bookedSlots = array_column($bookings, 'booking_slot');


// FOR date filter
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['filterDate'])) {
        $filterDate = $_GET['filterDate'];
        $bookedSlotQuery = "SELECT * FROM bookings WHERE booking_date = '$filterDate' ";
        $bookingsArr = [];
        $result = $conn->query($bookedSlotQuery);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bookingsArr[] = $row;
            }
        }
    }
}

$conn->close();
?>
<section>
    <h2>Dashboard</h2>
    <div class="summary">
        <h3>Lifetime Reports</h3>
        <div class="summary-container">
            <div class="box" style="margin-left: 0;">
                <div class="result">
                    <p><?php echo $resultArray["bookingSummarySql"] ?></p>
                    <p>Total Bookings</p>
                </div>
                <div class="icon-container">
                    <i class="fa-brands fa-font-awesome fa-2xl" style="color: white"></i>
                </div>
            </div>
            <div class="box">
                <div class="result">
                    <p><?php echo $resultArray["earningSummarySql"] == null ? '0' : $resultArray["earningSummarySql"] ?>
                    </p>
                    <p>Total Earning</p>
                </div>
                <div class="icon-container">
                    <i class="fa-solid fa-money-bills fa-2xl" style="color: white"></i>
                </div>
            </div>
            <div class="box">
                <div class="result">
                    <p><?php echo $resultArray["expenditureSummarySql"] == null ? '0' : $resultArray["expenditureSummarySql"] ?>
                    </p>
                    <p>Total Expenditure</p>
                </div>
                <div class="icon-container">
                    <i class="fa-solid fa-file-invoice-dollar fa-2xl" style="color: white"></i>
                </div>
            </div>
            <div class="box" style="margin-right: 0;">
                <div class="result">
                    <p><?php echo $resultArray["staffsSql"] ?></p>
                    <p>Total Staffs</p>
                </div>
                <div class="icon-container">
                    <i class="fa-solid fa-users fa-2xl" style="color:white"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="slot-container">
        <h3>Today's Booked slots</h3>
        <table class="greyGridTable">
            <tr>
                <?php
                $timeArr = [
                    '6-7 AM',
                    '7-8 AM',
                    '8-9 AM',
                    '9-10 AM',
                    '10-11 AM',
                    '11-12 PM',
                    '12-1 PM',
                    '1-2 PM',
                    '2-3 PM',
                    '3-4 PM',
                    '4-5 PM',
                    '5-6 PM',
                    '6-7 PM'
                ];
                foreach ($timeArr as $time) {
                    echo "<th>$time</th>";
                }
                ?>
            </tr>
            <tr>
                <?php

                foreach ($timeArr as $time) {
                    if (in_array($time, $bookedSlots)) {
                        echo "<td style='font-weight: bold'><i class='fa-solid fa-fire fa-shake' style='color: var(--primary);'></i>&nbsp;Booked</td>";
                    } else {
                        echo "<td>Vacant</td>";
                    }
                }
                ?>
            </tr>
        </table>
    </div>

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
                        <td><?= $list['payment_status'] ?></td>
                        <td>
                            <button class="primary-btn" style="font-size:1.5rem; background-color:green;"><i
                                    class="fa-solid fa-pen-to-square" style="color:white;"></i></button>
                            <button class="primary-btn" style="font-size:1.5rem; background-color:red;"><i
                                    class="fa-solid fa-trash" style="color:white;"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</section>