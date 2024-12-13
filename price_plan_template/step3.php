<div class="payment_method direct_bank_payment_method">
    <h3>Sing Up - Direct Bank</h3>
    <div class="direct_bank_payment_method_details">
        <h2 class="text-center mb-4">Your Bank Details</h2>
        <div class="top-error-message alert-danger" style="display:none"></div>
        <form id="bankDetailsForm">
        <!-- IBAN -->
        <div class="mb-3">
            <label for="iban" class="form-label">IBAN</label>
            <input type="text" class="form-control" id="iban" name="iban" placeholder="Enter your IBAN" required>
        </div>

        <!-- Bank Name -->
        <div class="mb-3">
            <label for="bankName" class="form-label">Bank Name</label>
            <input type="text" class="form-control" id="bankName" name="bankName" placeholder="Enter your bank name" required>
        </div>

        <!-- SWIFT/BIC Code -->
        <div class="mb-3">
            <label for="swiftCode" class="form-label">SWIFT/BIC Code</label>
            <input type="text" class="form-control" id="swift" name="swift" placeholder="Enter your SWIFT/BIC code" required>
        </div>

        <!-- Account Holder -->
        <div class="mb-3">
            <label for="accountHolder" class="form-label">Account Holder Name</label>
            <input type="text" class="form-control" id="accountHolder" name="accountHolder" placeholder="Enter the account holder's name" required>
        </div>
        </form>
    </div>
    <div class="row">
        <div class="col-sm-12 mb-3">
            <button type="button" class="btn goback btn-danger" data-back="step2" data-id="step3">Go Back</button>
            <button type="button" class="btn btn-danger" id="bank_detail_form">Continue</button>
        </div>
    </div>
</div>
<div class="payment_method recurring_payment_method" style="display:none;">
    <div class="top-error-message alert-danger" style="display:none"></div>
    <div id="payment-form-error-message" class="alert-danger"></div>
    <form id="process_payment" method="post" action="<?php echo site_url();?>/process-payment">
        <?php wp_nonce_field( 'process_payment_action', 'process_payment_field' ); ?>
        <div id="payment-form"></div>
    </form>
    <?php
    $permissions = [ 'PMT_POST_Create_Single'];
    $get_globalpay_access_token = get_globalpay_access_token($permissions);
    $auth_token = $get_globalpay_access_token['body'] ?? [];
    $token = $auth_token['token'] ?? '';
    ?>
    <script src="https://js.globalpay.com/v1/globalpayments.js"></script>
    <script>
    // configuring Drop-in UI
    GlobalPayments.configure({
        accessToken: "<?php echo $token;?>",
        apiVersion: "2021-03-22",
        env: "sandbox", // or "production"
        apms: {
            currencyCode: "EUR",
            allowedCardNetworks: ["VISA", "MASTERCARD", "AMEX", "DISCOVER"],
        }
    });
    </script>
</div>
<div class="loading" style="display:none">
    <div class="spinner-border" role="status">
        <span class="visually-hidden"></span>
    </div>
</div>