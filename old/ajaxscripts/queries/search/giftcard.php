<?php
include('../../../config.php');

$searchValue = $_POST['searchtxt'];

## Search

$searchQuery = " ";
if($searchValue != ''){
    $searchQuery = " and
    (phonenumber LIKE '%" . $searchValue . "%'
 OR fullname LIKE '%" . $searchValue . "%'
 OR phonenumber LIKE '%" . $searchValue . "%'
 OR giftnumber LIKE '%" . $searchValue . "%'
 OR giftvalue LIKE '%" . $searchValue . "%') ";
 }



$getdetails = $mysqli->query("select * from giftcard g
                            JOIN customer c ON c.cusid = g.customerid WHERE 
                            (g.status IS NULL AND 1 ".$searchQuery.")       
                            ORDER BY g.datetime DESC"); 

?>       


            <div class="table-responsive mt-2" id="search_table">
                <table class="table" id="table-data">
                    <thead>
                        <tr>
                            <th>Gift Card Number</th>
                            <th>Value</th>
                            <th>Customer Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($resdetails = $getdetails->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $resdetails['giftnumber'] ?></td>
                            <td><?php echo $resdetails['giftvalue'] ?></td>
                            <td><?php echo $resdetails['fullname'] ?></td>
                            <td>
                                <div class="text-center">
                                    <a class="viewgiftcardbtn" title="View Gift Card Details"  i_index=<?php echo $resdetails['giftid']; ?>>
                                        <span class="icon-wrapper cursor-pointer"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                                            stroke-linejoin="round" class="feather feather-eye">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle></svg>
                                        </span>
                                    </a>
                                   
                                    <a class="deletegiftcardbtn" title="Delete Gift Card Details" i_index=<?php echo $resdetails['giftid']; ?>>
                                        <span class="icon-wrapper cursor-pointer"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                            class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </span>
                                    </a>
     
                                 </div>

                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>



<script>
        oTable2 = $('#table-data').DataTable({
            stateSave: true,
            "bLengthChange": false,
            dom: "rtiplf",
            "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
            'processing': true,
            'serverMethod': 'post'
        });

</script>        