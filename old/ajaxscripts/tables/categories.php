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
                                       <table class="table mt-2" id="table-data">
                                       <thead>
                                           <tr>
                                            <th>Category Name</th>
                                            <th>Category Code</th>
                                            <th>Action</th>
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
        dom: "rtiplf",
        "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            url :"ajaxscripts/tables/pagination/category.php", // json datasource
        },
        'columns': [
            {data: 'categoryname'},
            {data: 'categorycode'},
            {data: 'action'}
        ]
    });
    $('#searchtxt').keyup(function () {
        oTable.search($(this).val()).draw();
    });
   

   </script> 