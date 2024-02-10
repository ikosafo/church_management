<?php
$expirydate = $_POST['expirydate'];

?>



<section id="datatable">
    <form class="faq-search-input mb-1">
        <div class="input-group input-group-merge">
            <div class="input-group-text">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>
            <input type="text" class="form-control" id="searchtxt" placeholder="Search ...">
        </div>
    </form>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table mt-2" id="table-data">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Expiry Date</th>
                            <th>Selling Price</th>
                            <th>Variation</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>

</section>
<!--/ Basic table -->


<script>
    oTable = $('#table-data').DataTable({
        stateSave: true,
        "bLengthChange": false,
        dom: "Bfrtip",
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            url: "ajaxscripts/tables/pagination/searchproducts.php?expirydate=<?php echo $expirydate ?>", // json datasource
        },
        'columns': [{
                data: 'product'
            },
            {
                data: 'quantity'
            },
            {
                data: 'expirydate'
            },
            {
                data: 'sellingprice'
            },
            {
                data: 'variations'
            }
        ]
    });
    $('#searchtxt').keyup(function() {
        oTable.search($(this).val()).draw();
    });
</script>