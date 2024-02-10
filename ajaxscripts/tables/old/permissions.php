<?php
include ('../../config.php');
include ('../../functions.php');

$query = $mysqli->query("select * from userpermission GROUP BY userid");

?>
<section id="datatable">
                         
                                  <div class="row">
                                      <div class="col-12">
                                      <div class="card">
                                          <table class="table mt-2" id="table-data">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Permission</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            while ($result = $query->fetch_assoc()) {
                                               
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php $userid = $result['userid']; 
                                                        echo getStaffName($userid); ?>
                                                    </td>
                                                    <td>
                                                        <?php $q = $mysqli->query("select * from userpermission where userid = '$userid'");
                                                         while ($r = $q->fetch_assoc()) {
                                                            $permid = $r ['permid'];
                                                            ?>
                                                                
                                                                <a class="deletepermissionbtn" title="Delete Permission"
                                                                    i_index=<?php echo $permid; ?>>
                                                                    <span class="icon-wrapper cursor-pointer" title="Delete Permission"> 
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                                        class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                                        <line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                                    </span>
                                                                 </a> 
                                                              <?php echo $r['permission'] ?><br/>
                                                             

                                                        <?php } ?>
                                                    </td>
                                                 
                                                </tr>

                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                          </table>
                                          
                                      </div>
                                      </div>
                                  </div>
    
                       </section>
   <!--/ Basic table -->
   
   <script>

   //Delete category after icon click
    $(document).off('click', '.deletepermissionbtn').on('click', '.deletepermissionbtn', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex);
        
        $.confirm({
            title: 'Delete Permission!',
            content: 'Are you sure to continue?',
            buttons: {
                no: {
                    text: 'No',
                    keys: ['enter', 'shift'],
                    backdrop: 'static',
                    keyboard: false,
                    action: function () {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function () {
                        $.ajax({
                            type: "POST",
                            url: "ajaxscripts/queries/delete/permission.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    url: "ajaxscripts/tables/permissions.php",
                                    beforeSend: function () {
                                        $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                                    },
                                    success: function (text) {
                                        $('#pagetable_div').html(text);
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status + " " + thrownError);
                                    },
                                    complete: function () {
                                        $.unblockUI();
                                    },

                                });
                            },

                            complete: function () {
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            }
                        });
                    }
                }
            }
        });


    });


 </script>