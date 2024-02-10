    <?php include('../../config.php'); ?>

    <form class="form form-horizontal">
      <div class="row">
        <div class="mb-1 col-md-4">
          <label class="form-label" for="dateofexpense">Date of Expense</label>
          <input type="text" id="dateofexpense" class="form-control" placeholder="Date of Expense" />
        </div>
        <div class="mb-1 col-md-4">
          <label class="form-label" for="amount">Amount Paid</label>
          <input type="text" id="amount" class="form-control" autocomplete="off" placeholder="Amount Paid" onkeypress="return isNumberKey(event)" />
        </div>
        <div class="mb-1 col-md-4">
          <label class="form-label" for="paymentmode">Payment Mode</label>
          <select id="paymentmode" class="form-select">
            <option></option>
            <option value="Cash">Cash</option>
            <option value="Cheque">Cheque</option>
            <option value="Gift Card">Gift Card</option>
            <option value="Debit Card">Debit Card</option>
            <option value="Credit Card">Credit Card</option>
            <option value="Store Accounts">Store Accounts</option>
            <option value="Points">Points</option>
            <option value="Other">Other</option>
          </select>
        </div>
      </div>
      <div class="row">

        <div class="mb-1 col-md-4">
          <label class="form-label" for="receipient">Receipient</label>
          <input type="text" id="receipient" class="form-control" placeholder="Receipient" />
        </div>
        <div class="mb-1 col-md-4">
          <label class="form-label" for="approvedby">Approved By</label>
          <input type="text" id="approvedby" class="form-control" placeholder="Approved By" />
        </div>
        <div class="mb-1 col-md-4">
          <label class="form-label" for="reasonforpayment">Reason for Payment</label>
          <textarea id="reasonforpayment" class="form-control" placeholder="Reason for Payment"></textarea>
        </div>

      </div>
      <div class="row">

        <div class="mb-1 col-md-4">
          <label class="form-label" for="description">Description</label>
          <textarea id="description" class="form-control" placeholder="Description"></textarea>
        </div>

      </div>

      <div class="row">
        <div class="col-sm-12 offset-sm-12">
          <button type="button" id="expensebtn" class="btn btn-primary me-1">Submit</button>
        </div>
      </div>

    </form>

    <script>
      $("#paymentmode").select2({
        placeholder: "Select Payment Mode",
        allowClear: true
      });

      $("#dateofexpense").flatpickr({
        maxDate: new Date
      });

      // Add action on form submit
      $("#expensebtn").click(function() {

        var dateofexpense = $("#dateofexpense").val();
        var amount = $("#amount").val();
        var paymentmode = $("#paymentmode").val();
        var receipient = $("#receipient").val();
        var approvedby = $("#approvedby").val();
        var reasonforpayment = $("#reasonforpayment").val();
        var description = $("#description").val();

        var error = '';
        if (dateofexpense == "") {
          error += 'Please select date of expense \n';
        }
        if (amount == "") {
          error += 'Please enter amount paid \n';
          $("#amount").focus();
        }
        if (paymentmode == "") {
          error += 'Please select payment mode \n';
        }
        if (receipient == "") {
          error += 'Please enter receipient \n';
          $("#receipient").focus();
        }
        if (approvedby == "") {
          error += 'Please enter who approved payment \n';
          $("#approvedby").focus();
        }
        if (reasonforpayment == "") {
          error += 'Please enter reason for payment \n';
          $("#reasonforpayment").focus();
        }
        if (approvedby == "") {
          error += 'Please enter who approved payment \n';
          $("#approvedby").focus();
        }

        if (error == "") {
          $.ajax({
            type: "POST",
            url: "ajaxscripts/queries/save/expense.php",
            beforeSend: function() {
              $.blockUI({
                message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
              });
            },
            data: {
              dateofexpense: dateofexpense,
              amount: amount,
              paymentmode: paymentmode,
              receipient: receipient,
              approvedby: approvedby,
              reasonforpayment: reasonforpayment,
              description: description
            },
            success: function(text) {
              //alert(text);

              $.ajax({
                url: "ajaxscripts/forms/addexpense.php",
                beforeSend: function() {
                  $.blockUI({
                    message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                  });
                },
                success: function(text) {
                  $('#pageform_div').html(text);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  alert(xhr.status + " " + thrownError);
                },
                complete: function() {
                  $.unblockUI();
                },

              });
              window.location.href = "/viewexpenses";


            },
            error: function(xhr, ajaxOptions, thrownError) {
              alert(xhr.status + " " + thrownError);
            },
            complete: function() {
              $.unblockUI();
            },
          });
        } else {
          $("#error_loc").notify(error, {
            position: "bottom"
          });
        }
        return false;

      });
    </script>