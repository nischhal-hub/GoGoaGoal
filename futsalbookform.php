<s?php include './includes/toppart.php' ; ?>

    <div class="body-container">
        <div id="sidebar-space" class="sidebar-space"></div>
        <div class="container">
            <section>

                <div id="modal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <p><img src="./assets/icons/icons8-tick.gif" alt="tick gif">&nbsp;&nbsp;&nbsp;&nbsp;Issue
                            submitted
                            succesfully.</p>
                    </div>
                </div>

                <form action="#" method="post" id="itemIssueForm">
                    <h4>Item Issue Form</h4>
                    <div>
                        <label for="studentName">Student name:</label>
                        <input type="text" id="studentName" name="studentName" pattern="^[A-Za-z\s]+$" required>
                    </div>
                    <div>
                        <label for="contact">Email Information:</label>
                        <input type="email" id="contact" name="contact" pattern="^\S+@\S+\.\S+$" required>
                    </div>
                    <div>
                        <label for="staffName">Staff name:</label>
                        <input type="text" id="staffName" name="staffName" pattern="^[A-Za-z\s]+$" required>
                    </div>
                    <div>
                        <label for="itemType">Select Item Type:</label>
                        <select id="itemType" name="itemType" required>
                            <option value="" disabled selected>Select item type</option>
                            <option value="Book">Book</option>
                            <option value="Journal">Journal</option>
                            <option value="CD">CD</option>
                        </select>
                    </div>
                    <div>
                        <label for="itemId" pattern="^[A-Za-z0-9]+$">Item id:</label>
                        <input type="text" id="itemId" name="itemId" required>
                    </div>
                    <div>
                        <label for="date">Issue date:</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div>
                        <label for="quantity" pattern="^\d+$">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="1" required>
                    </div>
                    <div>
                        <label for="specialRequests">Special Requests:</label>
                        <textarea id="specialRequests" name="specialRequests" rows="4"></textarea>
                    </div>
                    <div>
                        <input type="submit" value="Submit" id="myBtn" class="primary-btn" />
                    </div>
                </form>

                <p>Go back to home page.<a href="/index.html">Click here.</a> </p>
                </s>
        </div>

    </div>
    </section>
    </body>

    </html>