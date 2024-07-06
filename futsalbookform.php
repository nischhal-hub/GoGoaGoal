<?php include './includes/toppart.php'; ?>

<div class="body-container">
    <div id="sidebar-space" class="sidebar-space"></div>
    <div class="container">
        <section>

            <div id="modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p><img src="./assets/icons/icons8-tick.gif" alt="tick gif">&nbsp;&nbsp;&nbsp;&nbsp;Futsal Booked Successfully.</p>
                </div>
            </div>

            <form action="#" method="post" id="itemIssueForm">
                <h3>Item Issue Form</h3>
                <div>
                    <label for="studentName"><span>Bookers name:</span></label>
                    <input type="text" id="studentName" name="studentName" pattern="^[A-Za-z\s]+$" placeholder="Hari Bahadur" required>
                </div>
                <div>
                    <label for="contact">Email Information:</label>
                    <input type="email" id="contact" name="contact" pattern="^\S+@\S+\.\S+$" placeholder="hari@gmail.com" required>
                </div>
                <div>
                    <label for="contact">Contact:</label>
                    <input type="number" id="contact" name="contact" placeholder="9876543210" required>
                </div>
                <div>
                    <label for="itemType">Select Time Slot:</label>
                    <select id="itemType" name="itemType" required>
                        <option value="" disabled selected>Select Time</option>
                        <option value="6-7">6:00-7:00</option>
                        <option value="7-8">7:00-8:00</option>
                        <option value="8-9">8:00-9:00</option>
                    </select>
                </div>
                <div>
                    <label for="itemType">Payment Method:</label>
                    <select id="itemType" name="itemType" required>
                        <option value="" disabled selected>Select Payment</option>
                        <option value="cash">Cash</option>
                        <option value="online">Online</option>
                    </select>
                </div>
                <div>
                    <label for="specialRequests">Special Requests:</label>
                    <textarea id="specialRequests" name="specialRequests" rows="4"></textarea>
                </div>
                <div>
                    <button class="secondary-btn" type="submit" id="myBtn">Submit</button>
                </div>
            </form>

            <p style="text-align: center; font-size: 1.5rem;">Go back to home page.<a href="./index.php">Click here.</a> </p>
        </section>
    </div>

</div>

</body>

</html>