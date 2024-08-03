<?php
$sql = "SELECT exp_id, exp_name, exp_item_num, exp_amount, exp_date, 
     exp_amount / exp_item_num AS exp_item_cost, 
     DATE_FORMAT(exp_date, '%Y-%m') AS exp_month 
     FROM expenditure";
$result = $conn->query($sql);
$expenditureArr = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $expenditureArr[] = $row;
    }
}
?>

<div class="booking-details">
    <h3>Staff details</h3>
    <div class="filter-container">
        <form class="filter-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get"
            style="width:100%; border-radius:none; box-shadow:none; padding:0;margin:0; gap:2rem;">
            <input type="text" name="searchParam" placeholder="Search by name..." style="width: 200px;" required>
            <button class="secondary-btn" style="margin-left:2rem;" disabled><i
                    class="fa-solid fa-search"></i>&nbsp;Search</button>
        </form>

        <button class="primary-btn"><a href="./add-staff.php" style="display:flex;"><i
                    class="fa-solid fa-plus"></i>&nbsp;Expenditure</a></button>

    </div>
    <table class="booking-details-table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Item Number</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Item Cost</th>
            <th>Month</th>
        </tr>
        <?php if (empty($expenditureArr)): ?>
            <tr>
                <td colspan="6" style="text-align: center;">No data to show</td>
            </tr>
        <?php else: ?>
            <?php $i = 1; ?>
            <?php foreach ($expenditureArr as $list): ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $list['exp_name'] ?></td>
                    <td><?php echo $list['exp_item_num'] ?></td>
                    <td><?php echo $list['exp_amount'] ?></td>
                    <td><?php echo $list['exp_date'] ?></td>
                    <td><?php echo $list['exp_item_cost'] ?></td>
                    <td><?php echo $list['exp_month'] ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>