<section>

            <div id="modal" class="modal show">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p id="modal-message"><img src="./assets/icons/icons8-tick.gif"
                            alt="tick gif">&nbsp;&nbsp;&nbsp;&nbsp;Futsal Booked
                        Successfully.</p>
                </div>
            </div>

            <form class="form" action="futsalbookform.php" method="post" id="itemIssueForm">
                <h3>Track Expenditure</h3>
                <div>
                    <label for="name"><span>Expenditure name:</span></label>
                    <input type="text" id="name" name="bookersName" pattern="^[A-Za-z\s]+$" placeholder="Bo'ohw'o'wo'er"
                        required>
                </div>
                <div>
                    <label for="contact">How many items purchased?</label>
                    <input type="number" id="noOfitems" name="noOfitems" placeholder="2" required>
                </div>
                <div>
                    <label for="expAmount"><span>Expenditure amount:</span"></label>
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