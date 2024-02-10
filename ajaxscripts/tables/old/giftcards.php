                            <section id="datatable">
                                
                                <form class="faq-search-input">
                                      <div class="input-group input-group-merge">
                                      <div class="input-group-text">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" 
                                              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                              stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                              <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                          </svg>
                                      </div>
                                      <input type="text" class="form-control" id="searchtxt" placeholder="Search ...">
                                      </div>
                                  </form>
   
   
                                  <div class="row">
                                      <div class="col-12">
                                      <div class="card">
                                      <small>Type a minimum of three characters to search</small>
                                        <div id="searchtable"></div>

                                        <div class="table-responsive mt-2" id="tabledata_div">
                                          <table class="table mt-2" id="table-data">
                                            <thead>
                                                <tr>
                                                    <th>Gift Card Number</th>
                                                    <th>Value</th>
                                                    <th>Customer Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                          </table>
                                        </div>
                                          
                                      </div>
                                      </div>
                                  </div>
    
                       </section>
   <!--/ Basic table -->
   
   
   <script>
   
       oTable = $('#table-data').DataTable({
           stateSave: true,
           "bLengthChange": false,
           dom: "rtiplf",
           "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
           'processing': true,
           'serverSide': true,
           'serverMethod': 'post',
           'ajax': {
               url :"ajaxscripts/tables/pagination/giftcard.php", // json datasource
           },
           'columns': [
               {data: 'giftcardnumber'},
               {data: 'giftcardvalue'},
               {data: 'customername'},
               {data: 'action'}
           ]
       });
      /*  $('#searchtxt').keyup(function () {
           oTable.search($(this).val()).draw();
       }); */


        //setup before functions
     var typingTimer;                //timer identifier
        var doneTypingInterval = 500;  //time in ms, 0.5 second for example
        var $input = $('#searchtxt');

        //on keyup, start the countdown
        $input.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });

        //on keydown, clear the countdown 
        $input.on('keydown', function () {
        clearTimeout(typingTimer);
        });

        //user is "finished typing," do something
        function doneTyping () {
            //('start searching');
        //do something
        var txtlen = $input.val().length;
        var searchtxt = $("#searchtxt").val();
      
        //alert(renewal_search);

            if (txtlen > 2) {
                $("#tabledata_div").hide();
                $("#searchtable").show();
                $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/search/giftcard.php",
                beforeSend: function () {
                        $.blockUI({ message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>' });
                },
                data: {
                    searchtxt: searchtxt
                },
                success: function (text) {
                    //alert(text);
                    $('#searchtable').html(text);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                                $.unblockUI();
                },
            });
            }
            else {
                //$("#prov-table").DataTable().ajax.reload(null, false );
                $("#tabledata_div").show();
                $("#searchtable").hide();
            }
    
        }
      </script> 