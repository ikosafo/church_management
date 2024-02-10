<?php include('includes/authheader.php');
$random = rand(1, 10) . date("Y-m-d");
?>

<div class="auth-inner my-2" style="max-width:700px !important">
    <!-- Login basic -->
    <div class="card mb-0" id="error_loc">
        <div class="card-body">
            <a href="index.html" class="brand-logo">
                <!--  Logo here -->
                <h2 class="brand-text text-primary ms-1 text-uppercase">POS System Configuration</h2>
            </a>

            <h4 class="card-title mb-1 text-center">Welcome 👋, please fill in the form to set up account</h4>

            <form class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="companyname">Company Name</label>

                            <input type="text" id="companyname" class="form-control" placeholder="Company Name" aria-label="Company Name" aria-describedby="companyname" required />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter your company's name.</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="tagline">Tagline</label>
                            <input type="text" id="tagline" class="form-control" placeholder="Tagline" aria-label="tagline" required />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter tagline</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="tagline">Telephone</label>
                            <input type="text" id="telephone" class="form-control" placeholder="Telephone" aria-label="telephone" required />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter telephone</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="whatsapp">Whatsapp Number</label>
                            <input type="text" id="whatsapp" class="form-control" placeholder="Whatsapp" aria-label="whatsapp" required />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter whatsapp number</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="emailaddress">Email Address</label>
                            <input type="email" id="emailaddress" class="form-control" placeholder="Email Address" aria-label="telephone" />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter email address</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="currency">Currency</label>
                            <select id="currency" class="form-select select2" aria-label="currency" required>
                                <option>Select currency</option>
                                <option value="AFN - Afghan Afghani - ؋">AFN - Afghan Afghani - ؋</option>
                                <option value="ALL - Albanian Lek - Lek">ALL - Albanian Lek - Lek</option>
                                <option value="DZD - Algerian Dinar - دج">DZD - Algerian Dinar - دج</option>
                                <option value="AOA - Angolan Kwanza - Kz">AOA - Angolan Kwanza - Kz</option>
                                <option value="ARS - Argentine Peso - $">ARS - Argentine Peso - $</option>
                                <option value="AMD - Armenian Dram - ֏">AMD - Armenian Dram - ֏</option>
                                <option value="AWG - Aruban Florin - ƒ">AWG - Aruban Florin - ƒ</option>
                                <option value="AUD - Australian Dollar - $">AUD - Australian Dollar - $</option>
                                <option value="AZN - Azerbaijani Manat - m">AZN - Azerbaijani Manat - m</option>
                                <option value="BSD - Bahamian Dollar - B$">BSD - Bahamian Dollar - B$</option>
                                <option value="BHD - Bahraini Dinar - .د.ب">BHD - Bahraini Dinar - .د.ب</option>
                                <option value="BDT - Bangladeshi Taka - ৳">BDT - Bangladeshi Taka - ৳</option>
                                <option value="BBD - Barbadian Dollar - Bds$">BBD - Barbadian Dollar - Bds$</option>
                                <option value="BYR - Belarusian Ruble - Br">BYR - Belarusian Ruble - Br</option>
                                <option value="BEF - Belgian Franc - fr">BEF - Belgian Franc - fr</option>
                                <option value="BZD - Belize Dollar - $">BZD - Belize Dollar - $</option>
                                <option value="BMD - Bermudan Dollar - $">BMD - Bermudan Dollar - $</option>
                                <option value="BTN">BTN - Bhutanese Ngultrum - Nu.</option>
                                <option value="BTC">BTC - Bitcoin - ฿</option>
                                <option value="BOB">BOB - Bolivian Boliviano - Bs.</option>
                                <option value="BAM">BAM - Bosnia-Herzegovina Convertible Mark - KM</option>
                                <option value="BWP">BWP - Botswanan Pula - P</option>
                                <option value="BRL">BRL - Brazilian Real - R$</option>
                                <option value="GBP">GBP - British Pound Sterling - £</option>
                                <option value="BND">BND - Brunei Dollar - B$</option>
                                <option value="BGN">BGN - Bulgarian Lev - Лв.</option>
                                <option value="BIF">BIF - Burundian Franc - FBu</option>
                                <option value="KHR">KHR - Cambodian Riel - KHR</option>
                                <option value="CAD">CAD - Canadian Dollar - $</option>
                                <option value="CVE">CVE - Cape Verdean Escudo - $</option>
                                <option value="KYD">KYD - Cayman Islands Dollar - $</option>
                                <option value="XOF">XOF - CFA Franc BCEAO - CFA</option>
                                <option value="XAF">XAF - CFA Franc BEAC - FCFA</option>
                                <option value="XPF">XPF - CFP Franc - ₣</option>
                                <option value="CLP">CLP - Chilean Peso - $</option>
                                <option value="CNY">CNY - Chinese Yuan - ¥</option>
                                <option value="COP">COP - Colombian Peso - $</option>
                                <option value="KMF">KMF - Comorian Franc - CF</option>
                                <option value="CDF">CDF - Congolese Franc - FC</option>
                                <option value="CRC">CRC - Costa Rican ColÃ³n - ₡</option>
                                <option value="HRK">HRK - Croatian Kuna - kn</option>
                                <option value="CUC">CUC - Cuban Convertible Peso - $, CUC</option>
                                <option value="CZK">CZK - Czech Republic Koruna - Kč</option>
                                <option value="DKK">DKK - Danish Krone - Kr.</option>
                                <option value="DJF">DJF - Djiboutian Franc - Fdj</option>
                                <option value="DOP">DOP - Dominican Peso - $</option>
                                <option value="XCD">XCD - East Caribbean Dollar - $</option>
                                <option value="EGP">EGP - Egyptian Pound - ج.م</option>
                                <option value="ERN">ERN - Eritrean Nakfa - Nfk</option>
                                <option value="EEK">EEK - Estonian Kroon - kr</option>
                                <option value="ETB">ETB - Ethiopian Birr - Nkf</option>
                                <option value="EUR">EUR - Euro - €</option>
                                <option value="FKP">FKP - Falkland Islands Pound - £</option>
                                <option value="FJD">FJD - Fijian Dollar - FJ$</option>
                                <option value="GMD">GMD - Gambian Dalasi - D</option>
                                <option value="GEL">GEL - Georgian Lari - ლ</option>
                                <option value="DEM">DEM - German Mark - DM</option>
                                <option value="GHS" selected>GHS - Ghanaian Cedi - GH₵</option>
                                <option value="GIP">GIP - Gibraltar Pound - £</option>
                                <option value="GRD">GRD - Greek Drachma - ₯, Δρχ, Δρ</option>
                                <option value="GTQ">GTQ - Guatemalan Quetzal - Q</option>
                                <option value="GNF">GNF - Guinean Franc - FG</option>
                                <option value="GYD">GYD - Guyanaese Dollar - $</option>
                                <option value="HTG">HTG - Haitian Gourde - G</option>
                                <option value="HNL">HNL - Honduran Lempira - L</option>
                                <option value="HKD">HKD - Hong Kong Dollar - $</option>
                                <option value="HUF">HUF - Hungarian Forint - Ft</option>
                                <option value="ISK">ISK - Icelandic KrÃ³na - kr</option>
                                <option value="INR">INR - Indian Rupee - ₹</option>
                                <option value="IDR">IDR - Indonesian Rupiah - Rp</option>
                                <option value="IRR">IRR - Iranian Rial - ﷼</option>
                                <option value="IQD">IQD - Iraqi Dinar - د.ع</option>
                                <option value="ILS">ILS - Israeli New Sheqel - ₪</option>
                                <option value="ITL">ITL - Italian Lira - L,£</option>
                                <option value="JMD">JMD - Jamaican Dollar - J$</option>
                                <option value="JPY">JPY - Japanese Yen - ¥</option>
                                <option value="JOD">JOD - Jordanian Dinar - ا.د</option>
                                <option value="KZT">KZT - Kazakhstani Tenge - лв</option>
                                <option value="KES">KES - Kenyan Shilling - KSh</option>
                                <option value="KWD">KWD - Kuwaiti Dinar - ك.د</option>
                                <option value="KGS">KGS - Kyrgystani Som - лв</option>
                                <option value="LAK">LAK - Laotian Kip - ₭</option>
                                <option value="LVL">LVL - Latvian Lats - Ls</option>
                                <option value="LBP">LBP - Lebanese Pound - £</option>
                                <option value="LSL">LSL - Lesotho Loti - L</option>
                                <option value="LRD">LRD - Liberian Dollar - $</option>
                                <option value="LYD">LYD - Libyan Dinar - د.ل</option>
                                <option value="LTL">LTL - Lithuanian Litas - Lt</option>
                                <option value="MOP">MOP - Macanese Pataca - $</option>
                                <option value="MKD">MKD - Macedonian Denar - ден</option>
                                <option value="MGA">MGA - Malagasy Ariary - Ar</option>
                                <option value="MWK">MWK - Malawian Kwacha - MK</option>
                                <option value="MYR">MYR - Malaysian Ringgit - RM</option>
                                <option value="MVR">MVR - Maldivian Rufiyaa - Rf</option>
                                <option value="MRO">MRO - Mauritanian Ouguiya - MRU</option>
                                <option value="MUR">MUR - Mauritian Rupee - ₨</option>
                                <option value="MXN">MXN - Mexican Peso - $</option>
                                <option value="MDL">MDL - Moldovan Leu - L</option>
                                <option value="MNT">MNT - Mongolian Tugrik - ₮</option>
                                <option value="MAD">MAD - Moroccan Dirham - MAD</option>
                                <option value="MZM">MZM - Mozambican Metical - MT</option>
                                <option value="MMK">MMK - Myanmar Kyat - K</option>
                                <option value="NAD">NAD - Namibian Dollar - $</option>
                                <option value="NPR">NPR - Nepalese Rupee - ₨</option>
                                <option value="ANG">ANG - Netherlands Antillean Guilder - ƒ</option>
                                <option value="TWD">TWD - New Taiwan Dollar - $</option>
                                <option value="NZD">NZD - New Zealand Dollar - $</option>
                                <option value="NIO">NIO - Nicaraguan CÃ³rdoba - C$</option>
                                <option value="NGN">NGN - Nigerian Naira - ₦</option>
                                <option value="KPW">KPW - North Korean Won - ₩</option>
                                <option value="NOK">NOK - Norwegian Krone - kr</option>
                                <option value="OMR">OMR - Omani Rial - .ع.ر</option>
                                <option value="PKR">PKR - Pakistani Rupee - ₨</option>
                                <option value="PAB">PAB - Panamanian Balboa - B/.</option>
                                <option value="PGK">PGK - Papua New Guinean Kina - K</option>
                                <option value="PYG">PYG - Paraguayan Guarani - ₲</option>
                                <option value="PEN">PEN - Peruvian Nuevo Sol - S/.</option>
                                <option value="PHP">PHP - Philippine Peso - ₱</option>
                                <option value="PLN">PLN - Polish Zloty - zł</option>
                                <option value="QAR">QAR - Qatari Rial - ق.ر</option>
                                <option value="RON">RON - Romanian Leu - lei</option>
                                <option value="RUB">RUB - Russian Ruble - ₽</option>
                                <option value="RWF">RWF - Rwandan Franc - FRw</option>
                                <option value="SVC">SVC - Salvadoran ColÃ³n - ₡</option>
                                <option value="WST">WST - Samoan Tala - SAT</option>
                                <option value="SAR">SAR - Saudi Riyal - ﷼</option>
                                <option value="RSD">RSD - Serbian Dinar - din</option>
                                <option value="SCR">SCR - Seychellois Rupee - SRe</option>
                                <option value="SLL">SLL - Sierra Leonean Leone - Le</option>
                                <option value="SGD">SGD - Singapore Dollar - $</option>
                                <option value="SKK">SKK - Slovak Koruna - Sk</option>
                                <option value="SBD">SBD - Solomon Islands Dollar - Si$</option>
                                <option value="SOS">SOS - Somali Shilling - Sh.so.</option>
                                <option value="ZAR">ZAR - South African Rand - R</option>
                                <option value="KRW">KRW - South Korean Won - ₩</option>
                                <option value="XDR">XDR - Special Drawing Rights - SDR</option>
                                <option value="LKR">LKR - Sri Lankan Rupee - Rs</option>
                                <option value="SHP">SHP - St. Helena Pound - £</option>
                                <option value="SDG">SDG - Sudanese Pound - .س.ج</option>
                                <option value="SRD">SRD - Surinamese Dollar - $</option>
                                <option value="SZL">SZL - Swazi Lilangeni - E</option>
                                <option value="SEK">SEK - Swedish Krona - kr</option>
                                <option value="CHF">CHF - Swiss Franc - CHf</option>
                                <option value="SYP">SYP - Syrian Pound - LS</option>
                                <option value="STD">STD - São Tomé and Príncipe Dobra - Db</option>
                                <option value="TJS">TJS - Tajikistani Somoni - SM</option>
                                <option value="TZS">TZS - Tanzanian Shilling - TSh</option>
                                <option value="THB">THB - Thai Baht - ฿</option>
                                <option value="TOP">TOP - Tongan pa'anga - $</option>
                                <option value="TTD">TTD - Trinidad & Tobago Dollar - $</option>
                                <option value="TND">TND - Tunisian Dinar - ت.د</option>
                                <option value="TRY">TRY - Turkish Lira - ₺</option>
                                <option value="TMT">TMT - Turkmenistani Manat - T</option>
                                <option value="UGX">UGX - Ugandan Shilling - USh</option>
                                <option value="UAH">UAH - Ukrainian Hryvnia - ₴</option>
                                <option value="AED">AED - United Arab Emirates Dirham - إ.د</option>
                                <option value="UYU">UYU - Uruguayan Peso - $</option>
                                <option value="USD">USD - US Dollar - $</option>
                                <option value="UZS">UZS - Uzbekistan Som - лв</option>
                                <option value="VUV">VUV - Vanuatu Vatu - VT</option>
                                <option value="VEF">VEF - Venezuelan BolÃ­var - Bs</option>
                                <option value="VND - Vietnamese Dong - ₫">VND - Vietnamese Dong - ₫</option>
                                <option value="YER - Yemeni Rial - ﷼">YER - Yemeni Rial - ﷼</option>
                                <option value="ZMK - Zambian Kwacha - ZK">ZMK - Zambian Kwacha - ZK</option>
                            </select>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please select currency</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="d-block form-label" for="address">Address</label>
                            <textarea class="form-control" id="address" rows="3" required></textarea>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter your address.</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="logo">Logo</label>
                            <input id="file_upload" type="file" multiple="false" />
                            <div id="queue"></div>
                            <input type="hidden" id="selected" />

                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter tagline</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="username">System User</label>
                            <input type="text" id="username" class="form-control" placeholder="Username" aria-label="username" required />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter username</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="password">User Password</label>
                            <input type="password" id="password" class="form-control" placeholder="Password" aria-label="password" required />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter password</div>
                        </div>
                    </div>

                </div>

                <div class="mb-1">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="agreed" id="termsandconditions" required />
                        <label class="form-check-label" for="termsandconditions">Agree to our terms and conditions</label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                    </div>
                </div>
                <button type="submit" id="configbtn" class="btn btn-primary">Submit</button>
            </form>


        </div>
    </div>
    <!-- /Login basic -->
</div>
</div>

</div>
</div>
</div>
<!-- END: Content-->

<?php include('includes/authfooter.php'); ?>


<script type="text/javascript">
    $('#file_upload').uploadifive({
        'auto': false,
        //'checkScript'      : 'app-assets/uploadifive/check-exists.php',
        'uploadScript': 'ajaxscripts/queries/upload/sysconlogo.php',
        'formData': {
            'randno': '<?php echo $random ?>'
        },
        'queueID': 'queue',
        "fileType": '.gif, .jpg, .png, .jpeg',
        "multi": false,
        "height": 30,
        "width": 150,
        "fileSizeLimit": "20MB",
        "uploadLimit": 10,
        "buttonText": "Select Image",
        'removeCompleted': true,
        'onUploadComplete': function(file, data) {
            var obj = JSON.parse(data);
            console.log(data);
            //alert('hi');
        },
        'onSelect': function(file) {
            // Update selected so we know they have selected a file
            $("#selected").val('yes');
        },
        onCancel: function(file) {
            $("#selected").val('');
            //alert(file.name + " 已取消上传~!");
        },
        onFallback: function() {
            //alert("该浏览器无法使用!");
        },
        onUpload: function(file) {
            $("#selected").val('yes');
            //document.getElementById("submit").disabled = true;
        },
    });



    $("#configbtn").click(function() {

        var companyname = $("#companyname").val();
        var tagline = $("#tagline").val();
        var telephone = $("#telephone").val();
        var emailaddress = $("#emailaddress").val();
        var whatsapp = $("#whatsapp").val();
        var currency = $("#currency").val();
        var address = $("#address").val();
        var address = $("#address").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var selected = $("#selected").val();
        var sysconid = '<?php echo $random; ?>';
        var terms = $('input[name=agreed]:checked').val();
        //alert(terms);

        var error = '';
        if (companyname == "") {
            error += "Please enter company's name \n";
            $("#companyname").focus();
        }
        /* if (tagline == "") {
            error += 'Please enter company tagline \n';
            $("#tagline").focus();
        } */
        if (telephone == "") {
            error += 'Please enter telephone \n';
            $("#telephone").focus();
        }
        if (currency == "") {
            error += 'Please select currency \n';
            //$("#currency").focus();
        }
        if (address == "") {
            error += 'Please enter address \n';
            $("#address").focus();
        }
        if (terms == undefined) {
            error += 'Please accept terms and conditions  \n';
        }
        if (username == "") {
            error += 'Please enter username \n';
            $("#username").focus();
        }
        if (password == "") {
            error += 'Please enter password \n';
            $("#password").focus();
        }
        if (password != "" && password.length < 6) {
            error += 'Password length should not be less 6 \n';
            $("#password").focus();
        }
        if (selected != "yes") {
            error += 'Please upload logo \n';
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/systemconfig.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    companyname: companyname,
                    tagline: tagline,
                    telephone: telephone,
                    whatsapp: whatsapp,
                    emailaddress: emailaddress,
                    currency: currency,
                    address: address,
                    username: username,
                    password: password,
                    terms: terms,
                    sysconid: sysconid
                },
                success: function(text) {
                    $('#file_upload').uploadifive('upload');
                    //alert(text);
                    window.location.href = "login";
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
                position: "right"
            });
        }
        return false;

    });
</script>