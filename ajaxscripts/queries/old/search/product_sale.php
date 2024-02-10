<?php
$product_search = $_POST['product_search'];
?>

<style>
    .dt-buttons {
        display: none;
    }

    .fw-bolder {
        font-size: 11px;
    }

    .user-name.fw-bolder {
        font-size: 14px;
    }

    .badge {
        font-size: 9.5px;
    }

    div.text-muted,
    span.text-muted {
        font-size: 9.5px !important;
    }

    .prodsalestable th,
    .prodsalestable td {
        font-size: 10px !important;
    }

    .dataTables_info,
    ul.pagination {
        display: none;
    }
</style>

<section id="datatable">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table mt-2 table-sm prodsalestable" id="table-data">
                    <thead>
                        <tr>
                            <th width="25%">Product</th>
                            <th width="15%">Qty</th>
                            <th width="15%">Expiry Date</th>
                            <th width="15%">Selling Price</th>
                            <th width="10%">Var.</th>
                            <th width="10%">Action</th>
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
        "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            url: "ajaxscripts/tables/pagination/temp_sales.php?prodsearch=<?php echo $product_search; ?>", // json datasource
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
            },
            {
                data: 'action'
            }
        ]
    });
    $('#searchtxt').keyup(function() {
        oTable.search($(this).val()).draw();
    });
</script>