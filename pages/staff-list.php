<div class="booking-details">
            <h3>Staff details</h3>
            <div class="filter-container">
                <form class="filter-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get" style="width:100%; border-radius:none; box-shadow:none; padding:0;margin:0; gap:2rem;">
                    <input type="text" name="searchParam" placeholder="Search by name..." style="width: 200px;" required>
                    <button class="secondary-btn" style="margin-left:2rem;"><i class="fa-solid fa-search"></i>&nbsp;Search</button>
                </form>
               
                    <button class="primary-btn"><a href="./add-staff.php"  style="display:flex;"><i class="fa-solid fa-plus"></i>&nbsp;Staff</a></button>
               
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
                    <?php $i = 1; // Initialize the counter ?>
                    <?php foreach ($staffsArr as $list): ?>
                        <tr>
                            <td><?= htmlspecialchars($i) ?></td>
                            <td style="display:flex; align-items:center; justify-content:center;""><?php echo '<img class="avatar-img" src="data:image/jpeg;base64,'.base64_encode($list['staff_avatar']).'"/>'?> <?= htmlspecialchars($list['staff_name'])?> </td>
                            <td><?= htmlspecialchars($list['staff_contact']) ?></td>
                            <td><?= htmlspecialchars($list['staff_email']) ?></td>
                            <td><?= htmlspecialchars($list['staff_join_date']) ?></td>
                            <td>
                            <div class="action-container">
                                <form class="edit-form" action="">
                                <input type="hidden" name="id" value="<?php echo $list['staff_id'] ?>">
                                <button class="btn-success" style="font-size:1.5rem;"><i
                                class="fa-solid fa-pen-to-square"></i></button>
                                </form>
                                <form class="delete-form" action="./proccess/deletestaff.php">
                                    <input type="hidden" name="id" value="<?php echo $list['staff_id'] ?>">
                                    <button class="btn-danger" style="font-size:1.5rem;"><i
                                            class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                        </tr>
                        <?php $i++; // Increment the counter ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
        