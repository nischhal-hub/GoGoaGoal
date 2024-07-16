<?php 
    $staffSql = 'SELECT * FROM staffs';
    $result = $conn->query($staffSql);
    $staffsArr = [];
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            $staffsArr[] = $row;
        }
    }else{
        echo "Error".$conn->error."<br>";
    }

?>
<div class="booking-details">
        <h3>Staff details</h3>
        <div class="filter-container">
            <form class="filter-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get" style="width:100%; border-radius:none; box-shadow:none; padding:0;margin:0; gap:2rem;">
                <input type="date" name="filterDate" style="width: 200px;" required>
                <button class="primary-btn" style="margin-left:2rem;"><i class="fa-solid fa-filter"></i>&nbsp;Filter</button>
            </form>
        </div>
        <table class="booking-details-table">
            <tr>
                <th>S.N</th>
                <th>Staff Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Joined Date</th>
                <th>Action</th>
            </tr>
            <?php if (empty($staffsArr)): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No data to show</td>
                </tr>
            <?php else: ?>
                <?php foreach ($staffsArr as $list): ?>
                    <?php $i++; ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $list['staff_name'] ?></td>
                        <td><?= $list['staff_contact'] ?></td>
                        <td><?= $list['staff_email'] ?></td>
                        <td><?= $list['staff_join_date'] ?></td>
                        <td><button class="secondary-btn" style="font-size:1.5rem;">:</button></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>