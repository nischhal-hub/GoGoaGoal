<?php
include './includes/toppart.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<div class="body-container">
    <div id="sidebar-space" class="sidebar-space"></div>
    <div class="container">
        <div class="invoice-box" id="invoice">
            <table>
                <tr class="top">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td class="title" style="display:flex; justify-content: flex-start;">
                                    <img src="./assets/logo.png" style="width:60px;">
                                </td>
                                <td>
                                    Invoice #: 00302<br>
                                    Created: October 18, 2017
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="information">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td style="text-align:left;">
                                    Hello, Philip Brooks.<br>
                                    Thank you for your order.
                                </td>

                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="heading">
                    <td>Item Description</td>
                    <td>Item ID</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
                <tr class="item">
                    <td>Name or Description of item</td>
                    <td>MH792AM</td>
                    <td>1</td>
                    <td>Rs 100.00</td>
                </tr>
                <tr class="total">
                    <td colspan="3"></td>
                    <td>Subtotal: Rs 100.00</td>
                </tr>
                <tr class="total">
                    <td colspan="3"></td>
                    <td>Total: Rs 107.00</td>
                </tr>
                <tr class="information">
                    <td style="text-align:left;">
                        <strong>BILLING INFORMATION</strong><br>
                        Philip Brooks<br>
                        134 Madison Ave.<br>
                        New York NY 00102<br>
                        United States
                    </td>
                    <td style="text-align:left;">
                        <strong>PAYMENT INFORMATION</strong><br>
                        Credit Card<br>
                        Card Type: Visa<br>
                        .... .... .... 1234
                    </td>
                </tr>
            </table>
        </div>
        <div class="download-container">
            <button id="download" class="primary-btn">Download Bill</button>
        </div>
    </div>
</div>
</main>
</body>
<script>
    document.getElementById('download').addEventListener('click', () => {
        const invoice = document.getElementById('invoice');
        const options = {
            margin: 0.5,
            filename: 'invoice.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        html2pdf().from(invoice).set(options).save();
    });
</script>

</html>