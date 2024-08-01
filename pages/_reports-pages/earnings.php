<?php
$sql = "SELECT * FROM checkout";
$result = $conn->query($sql);
$incomeArr = [];
$total = 0;
$prevAmount = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $incomeArr[] = $row;
        $total += $row['amount']
;
    }
}
?>
<div>
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
                    <?php foreach ($incomeArr as $income): ?>
                        <tr>
                            <td><?= htmlspecialchars($income['checkout_at']) ?></td>
                            <td>Rs.<?= htmlspecialchars($income['amount']) ?></td>
                            <td><?php
                            if($prevAmount == 0) {
                                $percentage = 100;
                            }
                            else{
                                $percentage =number_format(abs(($income['amount'] - $prevAmount)) / $prevAmount * 100,1) ;
                            }
                            if ($income['amount'] > $prevAmount) { ?>
                                <div class="up">
                                    <div><img src="./assets/icons/icons8-up-52.png" alt="arrow" height="18" width="18"></div>
                                    <p><?php echo $percentage ?> % increased than yesterday</p>
                                </div>
                            <?php } else { ?>
                                <div class="up">
                                <img src="./assets/icons/icons8-down.png" alt="arrow" height="18" width="18">
                                <span><?php echo $percentage?> % decreased than yesterday</span>
                                </div>
                            <?php } ?>
                            </td>
                            <?php $prevAmount = $income['amount']; ?>
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