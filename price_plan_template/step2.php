<!--step 2 start-->
<h3>Your Details</h3>
<div id="step2-container">
    <form id="step2-form">
        <div class="selected_plan_details">
            <div class="row">
                <div class="col-md-6 mb-3 selected_plan_name_section">
                    <img src="" alt="selected plan image" title="selected plan image">
                    <h3>Selected Plan</h3>
                    <div class="plan_title"></div>
                </div>
                <div class="col-md-6 mb-3 selected_plan_price_section">
                    <div class="plan_price"></div>
                    <div class="plan_period"></div>
                    <button type="button" class="btn goback btn-danger" data-back="step1" data-id="step2">Change Price</button>
                </div>
            </div>
        </div>
        <div class="user_details">
            <div class="row">
                <div class="col-md-6 mb-3 selected_plan_personal_info">
                    <h3>Personal Information</h3>
                    <!-- First Name -->
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter your first name" required>
                        <span class="error" for="">
                    </div>

                    <!-- Surname -->
                    <div class="mb-3">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" class="form-control" name="surname" id="surname" placeholder="Enter your surname" required>
                    </div>

                    <!-- Mobile Number -->
                    <div class="mb-3">
                        <label for="mobileNumber" class="form-label">Mobile Number</label>
                        <input type="tel" class="form-control" name="mobileNumber" id="mobileNumber" placeholder="Enter your mobile number"
                            required minlength="6" maxlength="12">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>

                    <!-- Promo/Referral Code -->
                    <div class="mb-3">
                        <label for="promoCode" class="form-label">Promo/Referral Code</label>
                        <input type="text" class="form-control" id="promoCode" name="promoCode" placeholder="Enter promo or referral code">
                    </div>
                </div>
                <div class="col-md-6 mb-3 selected_plan_collection_info">
                    <h3>Collection Address</h3>
                    <!-- Your Address -->
                    <div class="mb-3">
                        <label for="yourAddress" class="form-label">Your Address</label>
                        <!--<input type="text" class="form-control" id="yourAddress" name="yourAddress" placeholder="Enter your address" required>-->
                        <div id="autoAddress"></div>
                    </div>
                    <!-- Confirm Address -->
                    <div class="mb-3">
                        <input type="button" class="form-control" id="confirmAddress" name="confirmAddress" value="Confirm Address">
                    </div>

                    <!-- House Number -->
                    <div class="mb-3">
                        <label for="houseNumber" class="form-label">House Number</label>
                        <input type="text" class="form-control" id="houseNumber" name="houseNumber" placeholder="Enter your house number"
                            required>
                    </div>

                    <!-- Address Line 1 -->
                    <div class="mb-3">
                        <label for="address1" class="form-label">Address Line 1</label>
                        <input type="text" class="form-control" id="address1" name="address1" placeholder="Enter address line 1" required>
                    </div>

                    <!-- Address Line 2 -->
                    <div class="mb-3">
                        <label for="address2" class="form-label">Address Line 2</label>
                        <input type="text" class="form-control" id="address2" name="address2" placeholder="Enter address line 2">
                    </div>

                    <!-- Address Line 3 -->
                    <div class="mb-3">
                        <label for="address3" class="form-label">Address Line 3</label>
                        <input type="text" class="form-control" id="address3" name="address3" placeholder="Enter address line 3">
                    </div>

                    <!-- Address Line 4 -->
                    <div class="mb-3">
                        <label for="address4" class="form-label">Address Line 4</label>
                        <input type="text" class="form-control" id="address4" name="address4" placeholder="Enter address line 4">
                    </div>

                    <!-- Eircode -->
                    <div class="mb-3">
                        <label for="eircode" class="form-label">Eircode</label>
                        <input type="text" class="form-control" id="eircode" name="eircode" placeholder="Enter your Eircode" required>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <label class="form-label"><input type="checkbox" name="sendOccasionalNews" id="sendOccasionalNews"
                            value="1" required> We would like to send you occasional news about The City Bin co. activities
                        to join our mailing list, simply, tik the box. you can unsubscribe at any time.</label>
                </div>
                <div class="col-sm-12 mb-3">
                    <label class="form-label"><input type="checkbox" name="termCondition" id="termCondition" value="1"
                            required> I fully agree to the <a href="">Terms & Conditions</a> of this service</label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <h3>Select Payment Method</h3>
                    <p>Choose a payment method you will use to make a recurring payment for the bin collections</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <button type="button" class="select_payment_method btn btn-danger" id="bank_payment">Direct Debit</button>
                    <button type="button" class="select_payment_method btn btn-danger" id="recurring_payment">Recurring Card</button>
                </div>
            </div>
        </div>
    </form>
</div>
