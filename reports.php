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
                <div class="box report-box" style="margin-left: 0;">
                    <div class="result">
                        <p><?php echo $resultArray["bookingSummarySql"] ?></p>
                        <p>Total Bookings</p>
                    </div>
                    <div class="icon-container">
                        <i class="fa-brands fa-font-awesome fa-2xl" style="color: var(--primary)"></i>
                    </div>
                </div>
                <div class="box report-box">
                    <div class="result">
                        <p><?php echo $resultArray["earningSummarySql"] == null ? '0' : $resultArray["earningSummarySql"] ?>
                        </p>
                        <p>Total Earning</p>
                    </div>
                    <div class="icon-container">
                        <i class="fa-solid fa-money-bills fa-2xl" style="color: var(--primary)"></i>
                    </div>
                </div>
                <div class="box report-box">
                    <div class="result">
                        <p><?php echo $resultArray["expenditureSummarySql"] == null ? '0' : $resultArray["expenditureSummarySql"] ?>
                        </p>
                        <p>Total Expenditure</p>
                    </div>
                    <div class="icon-container">
                        <i class="fa-solid fa-file-invoice-dollar fa-2xl" style="color: var(--primary)"></i>
                    </div>
                </div>
                <div class="box report-box" style="margin-right: 0;">
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

        <section class="page-container show-page">
            <?php include './pages/_reports-pages/bookings.php'?>
        </section>
        <section class="page-container">
            <?php include './pages/_reports-pages/earnings.php'?>
        </section>
        <section class="page-container">
            <?php include './pages/_reports-pages/expenditure.php'?>
        </section>
        <section class="page-container">
            <?php include './pages/_reports-pages/staff.php'?>
        </section>
        

    </div>

</div>
</main>
</body>
    <script>
        let pages = document.getElementsByClassName('box');
        let container = Array.from(document.getElementsByClassName('page-container'));
        for (let i = 0; i < pages.length; i++) {
            pages[i].addEventListener('click', () => {
                if (container[i].classList.contains('show-page')) 
                    container[i].classList.add('show-page');
                else{
                    container[i].classList.toggle('show-page');
                    const value = i;
                    container.filter((x,i) => i !== value).map(x => x.classList.remove('show-page'));
                }
            });
        }
    </script>
</html>