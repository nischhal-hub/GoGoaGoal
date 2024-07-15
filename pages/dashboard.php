<?php
    $bookingListSql = "SELECT * FROM bookings";
    $bookingSummarySql = "SELECT COUNT(*) FROM bookings";
    $earningSummarySql = "SELECT SUM(amount) FROM checkout";
    $expenditureSummarySql = "SELECT SUM(exp_amount) FROM expenditure";
    $staffsSql = "SELECT COUNT(*) FROM staff";
    
    $summaryQueries = [
        "SELECT COUNT(*) FROM bookings",
        "SELECT SUM(amount) FROM checkout",
        "SELECT SUM(exp_amount) FROM expenditure",
        "SELECT COUNT(*) FROM staff"
    ];
    $resultArray = ["bookingSummarySql"=>0,"earningSummarySql"=>0,"expenditureSummarySql"=>0,"staffsSql"=>0];
    $resultKeys = array_keys($resultArray);
    $index = 0;
    foreach ($summaryQueries as $key=>$query){
        if($result = $conn->query($query)) {
            $row = $result->fetch_assoc();
            $resultArray[$resultKeys[$index]] = reset($row);
        }
        else{
            echo 'Error:'.$conn->error.".<br>";
        }
        $index++;
    }

    $result = $conn->query($bookingListSql);
    $bookings = [];
    $i = 0;
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $bookings[] = $row;
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
                    <p><?php echo $resultArray["earningSummarySql"]==null? '0': $resultArray["earningSummarySql"] ?></p>
                    <p>Total Earning</p>
                </div>
                <div class="icon-container">
                    <i class="fa-solid fa-money-bills fa-2xl" style="color: white"></i>
                </div>
            </div>
            <div class="box">
                <div class="result">
                    <p><?php echo $resultArray["expenditureSummarySql"]==null? '0': $resultArray["expenditureSummarySql"] ?></p>
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
        <h3>Booked slots</h3>
        <table class="greyGridTable">
            <tr>
                <th>6:00-7:00</th>
                <th>7:00-8:00</th>
                <th>8:00-9:00</th>
                <th>9:00-10:00</th>
                <th>10:00-11:00</th>
                <th>11:00-12:00</th>
                <th>12:00-13:00</th>
                <th>13:00-14:00</th>
                <th>14:00-15:00</th>
                <th>15:00-16:00</th>
                <th>16:00-17:00</th>
                <th>17:00-18:00</th>
            </tr>
            <tr>
                <td>booked</td>
                <td>booked</td>
                <td>booked</td>
                <td>booked</td>
                <td>booked</td>
                <td>booked</td>
                <td>booked</td>
                <td>booked</td>
                <td>booked</td>
                <td>booked</td>
                <td>booked</td>
                <td>booked</td>
            </tr>
        </table>
    </div>

    <div class="booking-details">
        <h3>Booking details</h3>
        <div class="filter-container">
            <input type="date">
            <button class="primary-btn">Filter</button>
        </div>
        <table class="booking-details-table">
            <tr>
                <th>S.N</th>
                <th>Booking initiator</th>
                <th>Contact</th>
                <th>Booked time</th>
                <th>Payment Status</th>
            </tr>
            <?php foreach($bookings as $booking): ?>
                <?php $i++; ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $booking['initiator'] ?></td>
                <td><?= $booking['initiator_contact'] ?></td>
                <td><?= $booking['booking_slot'] ?></td>
                <td><?= $booking['payment_status'] ?></td>
            </tr>
            <?php endforeach; ?>
            
        </table>
    </div>
</section>