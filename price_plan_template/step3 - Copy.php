
<div class="payment_method direct_bank_payment_method"style="display:none;">
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
<div id="payment-form"></div>
<script src="https://js.globalpay.com/v1/globalpayments.js"></script>
<script>
   // configuring Drop-in UI
   GlobalPayments.configure({
      accessToken: "XJvPDCSr3H24GEG0UBPJ4WE1Zk8J",
      apiVersion: "2021-03-22",
      env: "sandbox", // or "production"
      apms: {
         currencyCode: "EUR",
         allowedCardNetworks: ["VISA", "MASTERCARD", "AMEX", "DISCOVER"],
         /*googlePay: {
            currencyCode: "EUR",
            countryCode: "IE",
            merchantName: 'Test Account',
            allowedAuthMethods: ["PAN_ONLY"],
            allowedCardNetworks: ["AMEX", "MASTERCARD", "VISA"],
            buttonType: "plain",
            merchantId: "MER_7e3e2c7df34f42819b3edee31022ee3f",
            globalPaymentsClientID: "MerchantId"
         }*/
      }
   });

// creating an instance of the payment form
   var cardForm = GlobalPayments.creditCard.form('#payment-form', {
      amount: "19.99",
      style: "gp-default",
      //apms: ["google-pay"]
   });

   // method to notify that payment form has been initialized
   cardForm.ready(() => {
      console.log("Registration of payment form occurred");
   });

   // appending the Google Pay token to the form as a hidden field and
   // submitting it to the server-side
   cardForm.on("token-success", (resp) => {
      // add payment token to form as a hidden input
      const token = document.createElement("input");
      token.type = "hidden";
      token.name = "google-pay-token";
      token.value = resp.paymentReference;

      // add payment method provider
      const provider = document.createElement("input");
      provider.type = "hidden";
      provider.name = "provider";
      provider.value = resp.details.apmProvider;

      // submit data to the integration's backend for processing
      const form = document.getElementById("payment-form");
      console.log('Token: '+token);
      form.appendChild(token);
      form.appendChild(provider);
      form.submit();
   });

   cardForm.on("token-success", (resp) => {
      console.log("Token success:", resp);
   });

   cardForm.on("token-error", (resp) => {
      console.error("Token error:", resp);
   });

    // field-level event handlers. example:
    cardForm.on("card-number", "register", () => {
        console.log("Registration of Card Number occurred");
    });
</script>

    <!--<div id="credit-card-form"></div>
    <script src="https://js.globalpay.com/4.0.20/globalpayments.js"></script>
    <script>
        const cardForm = GlobalPayments.creditCard.form("#credit-card-form", {
        style: "gp-default"
        });
    </script>
    <form id="payment-form" method="post" action="process_payment">
    <script src="https://js.globalpay.com/4.0.20/globalpayments.js"></script>
    <script>
        // configuring Drop-In UI
        // appending the token to the form as a hidden field and
        // submitting it to the server-side

        // configuring Drop-In UI
        GlobalPayments.configure({
            accessToken: "access-token",
            apiVersion: "2021-03-22",
            env: "sandbox" // or "production"
        });
        // method to notify that hosted fields have been initialized
        cardForm.ready(() => {
            console.log("Registration of all credit card fields occurred");
            //TODO: Add your successful message
        });

        cardForm.on("token-success", (resp) => {
            // add payment token to form as a hidden input
            console.log(resp);
            const token = document.createElement("input");
            token.type = "hidden";
            token.name = "payment-reference";
            token.value = resp.paymentReference;
            const form = document.getElementById("payment-form");
            form.appendChild(token);
            form.submit();
        });

        // add error handling if token generation is not successful
        cardForm.on("token-error", (resp) => {
            // TODO: Add your error handling
        });

        // field-level event handlers. example:
        cardForm.on("card-number", "register", () => {
            console.log("Registration of Card Number occurred");
        });
    </script>
    </form>-->
</div>