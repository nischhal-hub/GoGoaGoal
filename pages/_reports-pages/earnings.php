<?php

$sql = "SELECT DATE(checkout_at) as date, SUM(amount) as total_amount FROM checkout WHERE checkout_at>=DATE_SUB(CURRENT_DATE, INTERVAL 10 DAY) GROUP BY DATE(checkout_at) ";
$result = $conn->query($sql);
$incomeArr = [];
$groupedIncome = [];
$total = 0;
$prevAmount = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $incomeArr[] = $row;
        $total += $row['total_amount'];
    }
}


?>
<div>
    <div class="income-graph">
        <div>
            <h3>Income reports</h3>
            <div class="income-grid-table">
                <p>Last 10 days</p>
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Income(in Rs)</th>
                        <th>Status</th>
                    </tr>
                    <?php foreach ($incomeArr as $income): ?>
                        <tr>
                            <td><?= htmlspecialchars($income['date']) ?></td>
                            <td>Rs.<?= htmlspecialchars($income['total_amount']) ?></td>
                            <td><?php
                            if($prevAmount == 0) {
                                $percentage = 100;
                            }
                            else {
                                $percentage = number_format(abs(($income['total_amount'] - $prevAmount)) / $prevAmount * 100, 1);
                            }
                            if ($income['total_amount'] > $prevAmount) { ?>
                                <div class="up">
                                    <div><img src="./assets/icons/icons8-up-52.png" alt="arrow" height="18" width="18"></div>
                                    <p><?php echo $percentage ?>% increased than yesterday</p>
                                </div>
                            <?php } else { ?>
                                <div class="down">
                                    <img src="./assets/icons/icons8-down.png" alt="arrow" height="18" width="18">
                                    <span><?php echo $percentage ?>% decreased than yesterday</span>
                                </div>
                            <?php } ?>
                            </td>
                            <?php $prevAmount = $income['total_amount']; ?>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td style="font-weight: 700;">Total:</td>
                        <td style="font-weight: 700;">Rs.<?= $total ?></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
