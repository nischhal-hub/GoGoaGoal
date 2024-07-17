<div class="booking-details">
            <h3>Staff details</h3>
            <div class="filter-container">
                <form class="filter-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get" style="width:100%; border-radius:none; box-shadow:none; padding:0;margin:0; gap:2rem;">
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
                    <?php $i = 1; // Initialize the counter ?>
                    <?php foreach ($staffsArr as $list): ?>
                        <tr>
                            <td><?= htmlspecialchars($i) ?></td>
                            <td><?= htmlspecialchars($list['staff_name']) ?></td>
                            <td><?= htmlspecialchars($list['staff_contact']) ?></td>
                            <td><?= htmlspecialchars($list['staff_email']) ?></td>
                            <td><?= htmlspecialchars($list['staff_join_date']) ?></td>
                            <td>
                                <button class="primary-btn" style="font-size:1.5rem; background-color:green;"><i class="fa-solid fa-pen-to-square" style="color:white;"></i></button>
                                <button class="primary-btn" style="font-size:1.5rem; background-color:red;"><i class="fa-solid fa-trash" style="color:white;"></i></button>
                            </td>
                        </tr>
                        <?php $i++; // Increment the counter ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
        