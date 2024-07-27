<?php   

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $noOfitems = $_POST['noOfitems'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $invoiceSql = "INSERT INTO expenditure (exp_name, exp_item_num, exp_amount,exp_date)
                    VALUES (?, ?, ?,?);";
    if ($stmt = $conn->prepare($invoiceSql)) {
        $stmt->bind_param("ssss", $name, $noOfitems, $amount, $date);
        if ($stmt->execute()) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                    var modal = document.getElementById('modal');
                    modal.style.display = 'block';
                    var closeBtn = document.getElementsByClassName('close')[0];
                        closeBtn.onclick = function() {
                            modal.style.display = 'none';
                        }
            });
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
    }
}
?>
<section>

            <div id="modal" class="modal show">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p id="modal-message" style="text-align: center"><img src="./assets/icons/icons8-tick.gif"
                            alt="tick gif">&nbsp;&nbsp;&nbsp;&nbsp;Expenditure Added.😓</p>
                    <div>
                    <button class="primary-btn"><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Add another Expenditure</a></button>
                    <button class="secondary-btn"><a href="<?php echo $_SERVER['PHP_SELF']; ?>">View Expediture Records</a></button>
                    </div>
                </div>
            </div>

            <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="itemIssueForm">
                <h3>Track Expenditure</h3>
                <div>
                    <label for="name"><span>Expenditure name:</span></label>
                    <input type="text" id="name" name="name" pattern="^[A-Za-z\s]+$" placeholder="Bo'ohw'o'wo'er"
                        required>
                </div>
                <div>
                    <label for="contact">How many items purchased?</label>
                    <input type="number" id="noOfitems" name="noOfitems" placeholder="2" required>
                </div>
                <div>
                    <label for="expAmount"><span>Expenditure amount(in Rs.):</span"></label>
                    <input type="number" name="amount" id="expAmount" required>
                </div>
                <div>
                    <label for="expenseDate"><span>Date:</span"></label>
                    <input type="date" name="date" id="expenseDate" required>
                </div>
                <div>
                    <button class="secondary-btn" type="submit" id="myBtn" style="width: 100%;">Submit</button>
                </div>
            </form>

            <p style="text-align: center; font-size: 1.5rem;">Go back to home page.<a href="./index.php">Click here.</a>
            </p>
        </section>