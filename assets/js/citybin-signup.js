jQuery(document).ready(function () {
    //step1 select any price plan
    jQuery(document).on( 'click', '.get_this_plan', function(){
        const id = jQuery(this).data("id");
        const price = jQuery("#item_"+id).find('.card-price').html();
        const title = jQuery("#item_"+id).find('.card-title').html();
        let period = jQuery("#item_"+id).find('.card-period').html();
        let plan_period = '';
        if(period==1){
            plan_period = 'per month';
        }else if(period==12)
        {
            plan_period = 'per year';
        }

        jQuery(".selected_plan_details").find('.plan_title').html(title);
        jQuery(".selected_plan_details").find('.plan_price').html(price);
        jQuery(".selected_plan_details").find('.plan_period').html(plan_period);
        jQuery("#selected_plan_id").val(id);
        jQuery("#selected_plan_title").val(title);
        jQuery("#selected_plan_price").val(price);
        jQuery("#selected_plan_period").val(period);
        jQuery("#step1").hide();
        jQuery("#step2").show();
    });
    // goback from current step
    jQuery(document).on( 'click', '.goback', function(){
        const id = jQuery(this).data("id");
        const back = jQuery(this).data("back");
        jQuery('#'+id).hide();
        jQuery('#'+back).show();
    });

    // Apply user detail
    jQuery("#step2-form").validate({
        rules: {
            firstName: {
                required: true
            },
            surname: {
                required: true
            },
            mobileNumber: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 12
            },
            email: {
                required: true,
                email: true
            },
            /*yourAddress: {
                required: true
            },*/
            houseNumber: {
                required: true
            },
            address1: {
                required: true
            },
            address2: {
                required: true
            },
            address3: {
                required: true
            },
            address4: {
                required: true
            }
        },
        messages: {
            firstName: {
                required: "Please enter your first name."
            },
            surname: {
                required: "Please enter your surname."
            },
            mobileNumber: {
                required: "We need your mobile number for contact purposes.",
                digits: "Only numeric values are allowed for mobile numbers.",
                minlength: "Mobile number must be at least 6 digits.",
                maxlength: "Mobile number cannot exceed 12 digits."
            },
            email: {
                required: "Please provide your email address.",
                email: "Your email address must be in the format name@example.com."
            },
            /*yourAddress: {
                required: "Your address is needed to complete the process."
            },*/
            houseNumber: {
                required: "House number is required for delivery purposes."
            },
            address1: {
                required: "Address line 1 is mandatory."
            },
            address2: {
                required: "Address line 2 is mandatory."
            },
            address3: {
                required: "Address line 3 is mandatory."
            },
            address4: {
                required: "Address line 4 is mandatory."
            }
        },
        errorElement: "div", // Wrap error messages in a <div>
        errorPlacement: function (error, element) {
            error.addClass("error-message"); // Add a custom class for styling
            error.insertAfter(element); // Place the error after the input field
        },
        submitHandler: function (form) {
        }
    });

    jQuery(document).on( 'click', '.select_payment_method', function(){
        var isValid = true;
        var id = jQuery(this).attr('id');
        // Check each input
        jQuery("#step2-form input").each(function () {
          if (!jQuery(this).valid()) {
            isValid = false;
          }
        });

        if (isValid) {
          //alert("All fields are valid!");
          jQuery('#step2').hide();
          jQuery('#step3').show();
          if(id=='bank_payment'){
            jQuery('#step3').find('.direct_bank_payment_method').show();
            jQuery('#step3').find('.recurring_payment_method').hide();
          }else if(id=='recurring_payment'){
            jQuery('#step3').find('.direct_bank_payment_method').hide();
            jQuery('#step3').find('.recurring_payment_method').show();
          }
        } else {
          //alert("Please fix the errors!");
        }
    });

    // Extend jQuery Validate with custom methods
    jQuery.validator.addMethod("iban", function(value, element) {
        return this.optional(element) || /^[A-Z]{2}\d{2}[A-Z0-9]{1,30}$/.test(value);
    }, "Please enter a valid IBAN.");

    jQuery.validator.addMethod("swift", function(value, element) {
        return this.optional(element) || /^[A-Z]{4}[A-Z]{2}[A-Z0-9]{2}([A-Z0-9]{3})?$/.test(value);
    }, "Please enter a valid SWIFT/BIC code.");

    jQuery.validator.addMethod("bankName", function(value, element) {
        return this.optional(element) || /^[A-Za-z\s\.\,\-]{3,50}$/.test(value);
    }, "Please enter a valid bank name.");

    jQuery.validator.addMethod("accountHolder", function(value, element) {
        return this.optional(element) || /^[A-Za-z\s\.\-]{3,50}$/.test(value);
    }, "Please enter a valid account holder name.");

    jQuery('.direct_bank_payment_method_details').find('.top-error-message').html('').hide();
    // Apply validation for bank form
    jQuery("#bankDetailsForm").validate({
        rules: {
            iban: {
                required: true,
                iban: true
            },
            bankName: {
                required: true,
                bankName: true
            },
            swift: {
                required: true,
                swift: true
            },
            accountHolder: {
                required: true,
                accountHolder: true
            }
        },
        messages: {
            iban: {
                required: "IBAN is required."
            },
            bankName: {
                required: "Bank name is required."
            },
            swift: {
                required: "SWIFT/BIC code is required."
            },
            accountHolder: {
                required: "Account holder name is required."
            }
        },
        errorElement: "div", // Wrap error messages in a <div>
        errorPlacement: function (error, element) {
            error.addClass("error-message"); // Add a custom class for styling
            error.insertAfter(element); // Place the error after the input field
        },
        submitHandler: function(form) {
            alert("Validation successful!");
            //form.submit();
        }
    });

    // bank detail validation and form submit
    jQuery(document).on( 'click', '#bank_detail_form', function(){
        var isValid = true;
        var id = jQuery(this).attr('id');
        // Check each input
        jQuery("#bankDetailsForm input").each(function () {
            if (!jQuery(this).valid()) {
            isValid = false;
            }
        });

        if (isValid) {
            //alert("All fields are valid!");
            const form1Data = jQuery('#step1-form').serializeArray();
            const form2Data = jQuery('#step2-form').serializeArray();
            const form3Data = jQuery('#bankDetailsForm').serializeArray();

            // Combine the data into a single object
            const allData = [...form1Data, ...form2Data, ...form3Data];
            // Convert to a query string for AJAX submission
            const serializedData = jQuery.param(allData);
            // AJAX Request
            jQuery('.direct_bank_payment_method_details').find('.top-error-message').hide();
            jQuery('.direct_bank_payment_method_details').find('.top-error-message').html('').hide();
            jQuery( 'body' ).addClass('loading');
            jQuery( 'div.loading' ).show();
            jQuery.ajax({
                url: citybin_object.ajax_url, // Replace with your server endpoint
                type: 'POST',
                data: serializedData + '&action=user_info_store&nonce=' + citybin_object.nonce, // Append additional data if necessary
                success: function (response) {
                    if (response.success) {
                        // Update the Thank You page with returned data
                        jQuery('#thank-you-message').html(response.data.message);
                        jQuery('#step3').hide();
                        jQuery('#step4').show();
                    } else {
                        alert('Error: '+response.data.error);
                        jQuery('.direct_bank_payment_method_details').find('.top-error-message').html(response.data.error).show();
                        console.error('Error:', response.data.error);
                    }
                    jQuery( 'body' ).removeClass('loading');
                    jQuery( 'div.loading' ).hide();
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    jQuery('.direct_bank_payment_method_details').find('.top-error-message').html(response.data.error).show();
                    jQuery( 'body' ).removeClass('loading');
                    jQuery( 'div.loading' ).hide();
                }
            });

        } else {
            //alert("Please fix the errors!");
        }
    });

    // Apply validation for referral code apply form
    jQuery("#referralCodeApply").validate({
        rules: {
            accountNumber: {
                required: true,
            },
            pin: {
                required: true,
                digits: true,
                minlength: 4,
                maxlength: 8
            }
        },
        messages: {
            accountNumber: {
                required: "Account Number is required."
            },
            pin: {
                required: "Pin is required."
            }
        },
        errorElement: "div", // Wrap error messages in a <div>
        errorPlacement: function (error, element) {
            error.addClass("error-message"); // Add a custom class for styling
            error.insertAfter(element); // Place the error after the input field
        },
        submitHandler: function(form) {
            //alert("Validation successful!");
            //form.submit();
        }
    });

    //validation for referral code
    jQuery(document).on( 'click', '.get_referral_code', function(){
        var isValid = true;
        var id = jQuery(this).attr('id');
        // Check each input
        jQuery("#referralCodeApply input").each(function () {
            if (!jQuery(this).valid()) {
            isValid = false;
            }
        });

        if (isValid) {
            //alert("All fields are valid!");
        } else {
            //alert("Please fix the errors!");
        }
    });

    //read more less
    jQuery(".read-more-btn").on("click", function () {
        const index = jQuery(this).data("index");
        const $shortDesc = jQuery("#short-desc-" + index);
        const $fullDesc = jQuery("#full-desc-" + index);

        if ($fullDesc.css("display") === "none") {
            $fullDesc.show();
            $shortDesc.hide();
            jQuery(this).text("Read Less");
        } else {
            $fullDesc.hide();
            $shortDesc.show();
            jQuery(this).text("Read More");
        }
    });

    jQuery("#autoAddress").AutoAddress({
        key : "<Your Key Here>",
        vanityMode : true,
        addressProfile: "Wordpress-Gravity Forms",
        addressFoundLabel: "Postcode Found, address populated below",
        searchButtonLabel: "Confirm Address",
        onAddressFound: function (data) {
            var address = data.reformattedAddress;
            jQuery('#address1').val(data.reformattedAddress[0]);
            jQuery('#address2').val(data.reformattedAddress[1]);
            if(data.reformattedAddress[0] == null && data.reformattedAddress[1] == null){
                jQuery('#address1').val(data.reformattedAddress[2]);
            }
            else{
                jQuery('#address3').val(data.reformattedAddress[2]);
            }
            jQuery('#address4').val(data.reformattedAddress[3]);
            jQuery('#eircode').val(data.postcode);
        }
    });
});

// creating an instance of the payment form
var cardForm = GlobalPayments.creditCard.form('#payment-form', {
    style: "gp-default"
});

// success form submit process
 cardForm.on("token-success", (resp) => {
    // add payment token to form as a hidden input
    const errorDiv = document.getElementById("payment-form-error-message");
    if(errorDiv){
        errorDiv.innerHTML = '';
    }
    const token = document.createElement("input");
    token.type = "hidden";
    token.name = "google-pay-token";
    token.value = resp.paymentReference;
    // add payment method provider
    const provider = document.createElement("input");
    provider.type = "hidden";
    provider.name = "provider";
    provider.value = resp.details.apmProvider;

    const reference = document.createElement("input");
    reference.type = "hidden";
    reference.name = "reference";
    reference.value = resp.details.reference;

    const cardType = document.createElement("input");
    cardType.type = "hidden";
    cardType.name = "cardType";
    cardType.value = resp.details.cardType;

    const cardNumber = document.createElement("input");
    cardNumber.type = "hidden";
    cardNumber.name = "cardNumber";
    cardNumber.value = resp.details.cardNumber;

    const expiryMonth = document.createElement("input");
    expiryMonth.type = "hidden";
    expiryMonth.name = "expiryMonth";
    expiryMonth.value = resp.details.expiryMonth;

    const expiryYear = document.createElement("input");
    expiryYear.type = "hidden";
    expiryYear.name = "expiryYear";
    expiryYear.value = resp.details.expiryYear;

    // submit data to the integration's backend for processing
    const form = document.getElementById("process_payment");
    form.appendChild(token);
    form.appendChild(provider);
    form.appendChild(reference);
    form.appendChild(cardType);
    form.appendChild(cardNumber);
    form.appendChild(expiryMonth);
    form.appendChild(expiryYear);
    //form.submit();
    const form1Data = jQuery('#step1-form').serializeArray();
    const form2Data = jQuery('#step2-form').serializeArray();
    const form3Data = jQuery('#process_payment').serializeArray();
    // Combine the data into a single object
    const allData = [...form1Data, ...form2Data, ...form3Data];
    // Convert to a query string for AJAX submission
    const serializedData = jQuery.param(allData);
    jQuery( 'div.loading' ).show();
    jQuery('.recurring_payment_method').find('.top-error-message').hide();
    jQuery( 'body' ).addClass('loading');
    jQuery.ajax({
        url: 'http://localhost/wp-block-demo/process-payment', // Replace with your server endpoint
        type: 'POST',
        data: serializedData, // Append additional data if necessary
        success: function (response) {
            if (response.success) {
                // Update the Thank You page with returned data
                jQuery('#thank-you-message').html(response.data.message);
                jQuery('#step3').hide();
                jQuery('#step4').show();
            } else {
                alert('Error: '+response.data.error);
                jQuery('.recurring_payment_method').find('.top-error-message').html('Error '+response.data.error).show();
                //console.error('Error:', response.data.error);
            }
            jQuery( 'div.loading' ).hide();
            jQuery( 'body' ).removeClass('loading');
        },
        error: function (xhr, status, error) {
            //console.error('Error:', error);
            jQuery('.recurring_payment_method').find('.top-error-message').html('Error '+error.data.error).show();
            jQuery( 'div.loading' ).hide();
            jQuery( 'body' ).removeClass('loading');
        }
    });
});
// display token related error
cardForm.on("token-error", (resp) => {
    const errorDiv = document.getElementById("payment-form-error-message");
    errorDiv.innerHTML = resp.reasons[0].message;
});