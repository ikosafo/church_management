<?php include('../../config.php'); ?>

<form class="form form-horizontal">
  <div class="row">

    <?php
    // Fetch data from the first query
    $getsupplier1 = $mysqli->query("SELECT * FROM supplier WHERE status IS NULL");
    $data1 = [];
    while ($ressupplier1 = $getsupplier1->fetch_assoc()) {
      $data1[] = [
        'value' => $ressupplier1['fullname'] . ' - ' . $ressupplier1['companyname'],
        'label' => $ressupplier1['fullname'] . ' - ' . $ressupplier1['companyname'],
      ];
    }

    // Fetch data from the second query
    $getsupplier2 = $mysqli->query("SELECT DISTINCT supplier FROM products WHERE status IS NULL");
    $data2 = [];
    while ($ressupplier2 = $getsupplier2->fetch_assoc()) {
      $data2[] = [
        'value' => $ressupplier2['supplier'],
        'label' => $ressupplier2['supplier'],
      ];
    }

    // Merge and sort the data
    $mergedData = array_merge($data1, $data2);
    usort($mergedData, function ($a, $b) {
      return strcmp($a['label'], $b['label']);
    });
    ?>

    <div class="mb-1 col-md-6">
      <label class="form-label" for="supplier">Supplier</label>
      <!-- Generate the sorted HTML options -->
      <select id="supplier" class="form-select">
        <option></option>
        <?php foreach ($mergedData as $option) { ?>
          <option value="<?php echo $option['value']; ?>"><?php echo $option['label']; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="mb-1 col-md-6">
      <label class="form-label"></label> <br />
      <button type="button" id="statbtn" class="btn btn-primary me-1">Search</button>
    </div>

  </div>

</form>

<script>
  $("#supplier").select2({
    placeholder: "Select Supplier",
    allowClear: true
  });

  // Add action on form submit
  $("#statbtn").click(function() {
    var supplier = $("#supplier").val();

    var error = '';

    if (supplier == "") {
      error += 'Please select supplier \n';
    }

    if (error == "") {
      $.ajax({
        type: "POST",
        url: "ajaxscripts/queries/search/supplier.php",
        beforeSend: function() {
          $.blockUI({
            message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
          });
        },
        data: {
          supplier: supplier
        },
        success: function(text) {
          //alert(text);
          $('#searchform_div').html(text);
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + " " + thrownError);
        },
        complete: function() {
          $.unblockUI();
        },
      });
    } else {
      $.notify(error, {
        position: "top right"
      });
    }
    return false;

  });
</script>