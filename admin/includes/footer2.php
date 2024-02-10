</div>
</div>


<!-- begin:: Footer -->
<div class="kt-footer  kt-footer--extended  kt-grid__item" id="kt_footer"
     style="background-image: url('newassets/media/bg/bg-2.jpg');">

    <div class="kt-footer__bottom">
        <div class="kt-container ">
            <div class="kt-footer__wrapper">
                <div class="kt-footer__logo">
                    <div class="kt-footer__copyright">
                        <?php echo date('Y') ?>&nbsp;&copy;&nbsp;
                        <a href="../../" target="_blank"><?php echo $churcht ?></a>
                    </div>
                </div>
                <div class="kt-footer__menu">
                    <a href="javascript:;">Developers</a>
                    <a href="javascript:;">Contact</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: Footer -->
</div>
</div>
</div>

<!-- end:: Page -->

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>
<!-- end::Scrolltop -->

<script>
    document.querySelector("html").classList.add('js');

    var fileInput  = document.querySelector( ".input-file" ),
        button     = document.querySelector( ".input-file-trigger" ),
        the_return = document.querySelector(".file-return");

    button.addEventListener( "keydown", function( event ) {
        if ( event.keyCode == 13 || event.keyCode == 32 ) {
            fileInput.focus();
        }
    });
    button.addEventListener( "click", function( event ) {
        fileInput.focus();
        return false;
    });
    fileInput.addEventListener( "change", function( event ) {
        the_return.innerHTML = this.value;
    });
</script>


<!--begin::Global Theme Bundle(used by all pages) -->
<script src="../assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
<script src="../assets/js/scripts.bundle.js" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="../assets/plugins/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<script src="../assets/plugins/custom/gmaps/gmaps.js" type="text/javascript"></script>
<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="../assets/js/pages/dashboard.js" type="text/javascript"></script>
<script src="../assets/js/pages/custom/login/login-general.js" type="text/javascript"></script>
<script src="../assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript"></script>
<script src="../assets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<script src="../assets/js/pages/crud/datatables/extensions/buttons.js" type="text/javascript"></script>
<script src="../assets/js/pages/notify.js" type="text/javascript"></script>
<script src="../assets/js/custom.js" type="text/javascript"></script>
<script src="../assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="../assets/jquery-confirm/js/jquery-confirm.js" type="text/javascript"></script>
<script src="../assets/uploadify/jquery.uploadifive.js" type="text/javascript"></script>
<script src="../assets/js/dropzonejs.js" type="text/javascript"></script>

<!--end::Page Scripts -->
</body>
<!-- end::Body -->
</html>
