<?php
include './includes/toppart.php';

$staffSql = 'SELECT * FROM staff';
$result = $conn->query($staffSql);

if(isset($_GET['searchParam'])){
    $searchParam = $_GET['searchParam'];
    $staffSql = 'SELECT * FROM staff WHERE staff_name LIKE "%'.$searchParam.'%"';
    $result = $conn->query($staffSql);
}

if ($result === FALSE) {
    echo "Error: " . $conn->error . "<br>";
} else {
    $staffsArr = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $staffsArr[] = $row;
        }
    }
}
?>

<div class="body-container">
    <div id="sidebar-space" class="sidebar-space"></div>
    <div class="container">
        <?php include_once './pages/staff-list.php'?>
    </div>
</div>
</main>
</body>
</html>
