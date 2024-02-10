<<<<<<< HEAD
<?php
include('../../config.php');

$getdetails = $mysqli->query("select * from system_config LIMIT 1");
$resdetails = $getdetails->fetch_assoc();
$random = $resdetails['sysconid'];
$theid = $resdetails['sysid'];

?>
<form class="needs-validation" novalidate>
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="companyname">Company Name</label>

                <input type="text" id="companyname" class="form-control" placeholder="Company Name" aria-label="Company Name" aria-describedby="companyname" value="<?php echo $resdetails['companyname']; ?>" required />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter your company's name.</div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="tagline">Tagline</label>
                <input type="text" id="tagline" class="form-control" placeholder="Tagline" aria-label="tagline" value="<?php echo $resdetails['tagline']; ?>" required />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter tagline</div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="tagline">Telephone</label>
                <input type="text" id="telephone" class="form-control" placeholder="Telephone" aria-label="telephone" value="<?php echo $resdetails['telephone']; ?>" required />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter telephone</div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="whatsapp">Whatsapp Number</label>
                <input type="text" id="whatsapp" class="form-control" placeholder="Whatsapp" aria-label="whatsapp" value="<?php echo $resdetails['whatsapp']; ?>" />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter whatsapp number</div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="emailaddress">Email Address</label>
                <input type="email" id="emailaddress" class="form-control" placeholder="Email Address" aria-label="telephone" value="<?php echo $resdetails['emailaddress']; ?>" />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter email address</div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="currency">Currency</label>
                <select id="currency" class="form-select select2" aria-label="currency" required>
                    <option>Select currency</option>
                    <option>AFN - Afghan Afghani - ؋</option>
                    <option>ALL - Albanian Lek - Lek</option>
                    <option>DZD - Algerian Dinar - دج</option>
                    <option>AOA - Angolan Kwanza - Kz</option>
                    <option>ARS - Argentine Peso - $</option>
                    <option>AMD - Armenian Dram - ֏</option>
                    <option>AWG - Aruban Florin - ƒ</option>
                    <option>AUD - Australian Dollar - $</option>
                    <option>AZN - Azerbaijani Manat - m</option>
                    <option>BSD - Bahamian Dollar - B$</option>
                    <option>BHD - Bahraini Dinar - .د.ب</option>
                    <option>BDT - Bangladeshi Taka - ৳</option>
                    <option>BBD - Barbadian Dollar - Bds$</option>
                    <option>BYR - Belarusian Ruble - Br</option>
                    <option>BEF - Belgian Franc - fr</option>
                    <option>BZD - Belize Dollar - $</option>
                    <option>BMD - Bermudan Dollar - $</option>
                    <option>BTN - Bhutanese Ngultrum - Nu.</option>
                    <option>BTC - Bitcoin - ฿</option>
                    <option>BOB - Bolivian Boliviano - Bs.</option>
                    <option>BAM - Bosnia-Herzegovina Convertible Mark - KM</option>
                    <option>BWP - Botswanan Pula - P</option>
                    <option>BRL - Brazilian Real - R$</option>
                    <option>GBP - British Pound Sterling - £</option>
                    <option>BND - Brunei Dollar - B$</option>
                    <option>BGN - Bulgarian Lev - Лв.</option>
                    <option>BIF - Burundian Franc - FBu</option>
                    <option>KHR - Cambodian Riel - KHR</option>
                    <option>CAD - Canadian Dollar - $</option>
                    <option>CVE - Cape Verdean Escudo - $</option>
                    <option>KYD - Cayman Islands Dollar - $</option>
                    <option>XOF - CFA Franc BCEAO - CFA</option>
                    <option>XAF - CFA Franc BEAC - FCFA</option>
                    <option>XPF - CFP Franc - ₣</option>
                    <option>CLP - Chilean Peso - $</option>
                    <option>CNY - Chinese Yuan - ¥</option>
                    <option>COP - Colombian Peso - $</option>
                    <option>KMF - Comorian Franc - CF</option>
                    <option>CDF - Congolese Franc - FC</option>
                    <option>CRC - Costa Rican ColÃ³n - ₡</option>
                    <option>HRK - Croatian Kuna - kn</option>
                    <option>CUC - Cuban Convertible Peso - $, CUC</option>
                    <option>CZK - Czech Republic Koruna - Kč</option>
                    <option>DKK - Danish Krone - Kr.</option>
                    <option>DJF - Djiboutian Franc - Fdj</option>
                    <option>DOP - Dominican Peso - $</option>
                    <option>XCD - East Caribbean Dollar - $</option>
                    <option>EGP - Egyptian Pound - ج.م</option>
                    <option>ERN - Eritrean Nakfa - Nfk</option>
                    <option>EEK - Estonian Kroon - kr</option>
                    <option>ETB - Ethiopian Birr - Nkf</option>
                    <option>EUR - Euro - €</option>
                    <option>FKP - Falkland Islands Pound - £</option>
                    <option>FJD - Fijian Dollar - FJ$</option>
                    <option>GMD - Gambian Dalasi - D</option>
                    <option>GEL - Georgian Lari - ლ</option>
                    <option>DEM - German Mark - DM</option>
                    <option selected>GHS - Ghanaian Cedi - GH₵</option>
                    <option>GIP - Gibraltar Pound - £</option>
                    <option>GRD - Greek Drachma - ₯, Δρχ, Δρ</option>
                    <option>GTQ - Guatemalan Quetzal - Q</option>
                    <option>GNF - Guinean Franc - FG</option>
                    <option>GYD - Guyanaese Dollar - $</option>
                    <option>HTG - Haitian Gourde - G</option>
                    <option>HNL - Honduran Lempira - L</option>
                    <option>HKD - Hong Kong Dollar - $</option>
                    <option>HUF - Hungarian Forint - Ft</option>
                    <option>ISK - Icelandic KrÃ³na - kr</option>
                    <option>INR - Indian Rupee - ₹</option>
                    <option>IDR - Indonesian Rupiah - Rp</option>
                    <option>IRR - Iranian Rial - ﷼</option>
                    <option>IQD - Iraqi Dinar - د.ع</option>
                    <option>ILS - Israeli New Sheqel - ₪</option>
                    <option>ITL - Italian Lira - L,£</option>
                    <option>JMD - Jamaican Dollar - J$</option>
                    <option>JPY - Japanese Yen - ¥</option>
                    <option>JOD - Jordanian Dinar - ا.د</option>
                    <option>KZT - Kazakhstani Tenge - лв</option>
                    <option>KES - Kenyan Shilling - KSh</option>
                    <option>KWD - Kuwaiti Dinar - ك.د</option>
                    <option>KGS - Kyrgystani Som - лв</option>
                    <option>LAK - Laotian Kip - ₭</option>
                    <option>LVL - Latvian Lats - Ls</option>
                    <option>LBP - Lebanese Pound - £</option>
                    <option>LSL - Lesotho Loti - L</option>
                    <option>LRD - Liberian Dollar - $</option>
                    <option>LYD - Libyan Dinar - د.ل</option>
                    <option>LTL - Lithuanian Litas - Lt</option>
                    <option>MOP - Macanese Pataca - $</option>
                    <option>MKD - Macedonian Denar - ден</option>
                    <option>MGA - Malagasy Ariary - Ar</option>
                    <option>MWK - Malawian Kwacha - MK</option>
                    <option>MYR - Malaysian Ringgit - RM</option>
                    <option>MVR - Maldivian Rufiyaa - Rf</option>
                    <option>MRO - Mauritanian Ouguiya - MRU</option>
                    <option>MUR - Mauritian Rupee - ₨</option>
                    <option>MXN - Mexican Peso - $</option>
                    <option>MDL - Moldovan Leu - L</option>
                    <option>MNT - Mongolian Tugrik - ₮</option>
                    <option>MAD - Moroccan Dirham - MAD</option>
                    <option>MZM - Mozambican Metical - MT</option>
                    <option>MMK - Myanmar Kyat - K</option>
                    <option>NAD - Namibian Dollar - $</option>
                    <option>NPR - Nepalese Rupee - ₨</option>
                    <option>ANG - Netherlands Antillean Guilder - ƒ</option>
                    <option>TWD - New Taiwan Dollar - $</option>
                    <option>NZD - New Zealand Dollar - $</option>
                    <option>NIO - Nicaraguan CÃ³rdoba - C$</option>
                    <option>NGN - Nigerian Naira - ₦</option>
                    <option>KPW - North Korean Won - ₩</option>
                    <option>NOK - Norwegian Krone - kr</option>
                    <option>OMR - Omani Rial - .ع.ر</option>
                    <option>PKR - Pakistani Rupee - ₨</option>
                    <option>PAB - Panamanian Balboa - B/.</option>
                    <option>PGK - Papua New Guinean Kina - K</option>
                    <option>PYG - Paraguayan Guarani - ₲</option>
                    <option>PEN - Peruvian Nuevo Sol - S/.</option>
                    <option>PHP - Philippine Peso - ₱</option>
                    <option>PLN - Polish Zloty - zł</option>
                    <option>QAR - Qatari Rial - ق.ر</option>
                    <option>RON - Romanian Leu - lei</option>
                    <option>RUB - Russian Ruble - ₽</option>
                    <option>RWF - Rwandan Franc - FRw</option>
                    <option>SVC - Salvadoran ColÃ³n - ₡</option>
                    <option>WST - Samoan Tala - SAT</option>
                    <option>SAR - Saudi Riyal - ﷼</option>
                    <option>RSD - Serbian Dinar - din</option>
                    <option>SCR - Seychellois Rupee - SRe</option>
                    <option>SLL - Sierra Leonean Leone - Le</option>
                    <option>SGD - Singapore Dollar - $</option>
                    <option>SKK - Slovak Koruna - Sk</option>
                    <option>SBD - Solomon Islands Dollar - Si$</option>
                    <option>SOS - Somali Shilling - Sh.so.</option>
                    <option>ZAR - South African Rand - R</option>
                    <option>KRW - South Korean Won - ₩</option>
                    <option>XDR - Special Drawing Rights - SDR</option>
                    <option>LKR - Sri Lankan Rupee - Rs</option>
                    <option>SHP - St. Helena Pound - £</option>
                    <option>SDG - Sudanese Pound - .س.ج</option>
                    <option>SRD - Surinamese Dollar - $</option>
                    <option>SZL - Swazi Lilangeni - E</option>
                    <option>SEK - Swedish Krona - kr</option>
                    <option>CHF - Swiss Franc - CHf</option>
                    <option>SYP - Syrian Pound - LS</option>
                    <option>STD - São Tomé and Príncipe Dobra - Db</option>
                    <option>TJS - Tajikistani Somoni - SM</option>
                    <option>TZS - Tanzanian Shilling - TSh</option>
                    <option>THB - Thai Baht - ฿</option>
                    <option>TOP - Tongan pa'anga - $</option>
                    <option>TTD - Trinidad & Tobago Dollar - $</option>
                    <option>TND - Tunisian Dinar - ت.د</option>
                    <option>TRY - Turkish Lira - ₺</option>
                    <option>TMT - Turkmenistani Manat - T</option>
                    <option>UGX - Ugandan Shilling - USh</option>
                    <option>UAH - Ukrainian Hryvnia - ₴</option>
                    <option>AED - United Arab Emirates Dirham - إ.د</option>
                    <option>UYU - Uruguayan Peso - $</option>
                    <option>USD - US Dollar - $</option>
                    <option>UZS - Uzbekistan Som - лв</option>
                    <option>VUV - Vanuatu Vatu - VT</option>
                    <option>VEF - Venezuelan BolÃ­var - Bs</option>
                    <option>VND - Vietnamese Dong - ₫</option>
                    <option>YER - Yemeni Rial - ﷼</option>
                    <option>ZMK - Zambian Kwacha - ZK</option>
                </select>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please select currency</div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="d-block form-label" for="address">Address</label>
                <textarea class="form-control" id="address" rows="3" required><?php echo $resdetails['address']; ?></textarea>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter your address.</div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="logo">Logo</label>
                <input id="file_upload" type="file" multiple="false" />
                <div id="queue"></div>
                <div class="profile-img mt-1">
                    <img src="<?php echo $resdetails['logo']; ?>" style="width:50%" class="rounded img-fluid" alt="User image">
                </div>
                <input type="hidden" id="selected" />

                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter tagline</div>
            </div>
        </div>

    </div>

    <button type="button" id="configbtn" class="btn btn-primary">Update</button>
</form>


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


    $("#currency").select2({
        placeholder: "Select Currency",
        allowClear: true
    });


    // Add action on form submit
    $("#configbtn").click(function() {

        var companyname = $("#companyname").val();
        var tagline = $("#tagline").val();
        var telephone = $("#telephone").val();
        var currency = $("#currency").val();
        var address = $("#address").val();
        var address = $("#address").val();
        var emailaddress = $("#emailaddress").val();
        var whatsapp = $("#whatsapp").val();
        var sysconid = '<?php echo $random; ?>';
        var theid = '<?php echo $theid ?>';

        var error = '';

        if (companyname == "") {
            error += "Please enter company's name \n";
            $("#companyname").focus();
        }
        if (tagline == "") {
            error += 'Please enter company tagline \n';
            $("#tagline").focus();
        }
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


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/edit/systemconfig.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    companyname: companyname,
                    tagline: tagline,
                    telephone: telephone,
                    emailaddress: emailaddress,
                    whatsapp: whatsapp,
                    currency: currency,
                    address: address,
                    sysconid: sysconid,
                    theid: theid
                },
                success: function(text) {
                    $('#file_upload').uploadifive('upload');
                    alert(text);
                    location.reload();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function() {
                    $.unblockUI();
                },
            });
        } else {
            $("#error_loc").notify(error);
        }
        return false;

    });
=======
<?php
include('../../config.php');

$getdetails = $mysqli->query("select * from system_config LIMIT 1");
$resdetails = $getdetails->fetch_assoc();
$random = $resdetails['sysconid'];
$theid = $resdetails['sysid'];

?>
<form class="needs-validation" novalidate>
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="companyname">Company Name</label>

                <input type="text" id="companyname" class="form-control" placeholder="Company Name" aria-label="Company Name" aria-describedby="companyname" value="<?php echo $resdetails['companyname']; ?>" required />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter your company's name.</div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="tagline">Tagline</label>
                <input type="text" id="tagline" class="form-control" placeholder="Tagline" aria-label="tagline" value="<?php echo $resdetails['tagline']; ?>" required />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter tagline</div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="tagline">Telephone</label>
                <input type="text" id="telephone" class="form-control" placeholder="Telephone" aria-label="telephone" value="<?php echo $resdetails['telephone']; ?>" required />
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
                <input type="email" id="emailaddress" class="form-control" placeholder="Email Address" aria-label="telephone" value="<?php echo $resdetails['emailaddress']; ?>" />
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter email address</div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="currency">Currency</label>
                <select id="currency" class="form-select select2" aria-label="currency" required>
                    <option>Select currency</option>
                    <option>AFN - Afghan Afghani - ؋</option>
                    <option>ALL - Albanian Lek - Lek</option>
                    <option>DZD - Algerian Dinar - دج</option>
                    <option>AOA - Angolan Kwanza - Kz</option>
                    <option>ARS - Argentine Peso - $</option>
                    <option>AMD - Armenian Dram - ֏</option>
                    <option>AWG - Aruban Florin - ƒ</option>
                    <option>AUD - Australian Dollar - $</option>
                    <option>AZN - Azerbaijani Manat - m</option>
                    <option>BSD - Bahamian Dollar - B$</option>
                    <option>BHD - Bahraini Dinar - .د.ب</option>
                    <option>BDT - Bangladeshi Taka - ৳</option>
                    <option>BBD - Barbadian Dollar - Bds$</option>
                    <option>BYR - Belarusian Ruble - Br</option>
                    <option>BEF - Belgian Franc - fr</option>
                    <option>BZD - Belize Dollar - $</option>
                    <option>BMD - Bermudan Dollar - $</option>
                    <option>BTN - Bhutanese Ngultrum - Nu.</option>
                    <option>BTC - Bitcoin - ฿</option>
                    <option>BOB - Bolivian Boliviano - Bs.</option>
                    <option>BAM - Bosnia-Herzegovina Convertible Mark - KM</option>
                    <option>BWP - Botswanan Pula - P</option>
                    <option>BRL - Brazilian Real - R$</option>
                    <option>GBP - British Pound Sterling - £</option>
                    <option>BND - Brunei Dollar - B$</option>
                    <option>BGN - Bulgarian Lev - Лв.</option>
                    <option>BIF - Burundian Franc - FBu</option>
                    <option>KHR - Cambodian Riel - KHR</option>
                    <option>CAD - Canadian Dollar - $</option>
                    <option>CVE - Cape Verdean Escudo - $</option>
                    <option>KYD - Cayman Islands Dollar - $</option>
                    <option>XOF - CFA Franc BCEAO - CFA</option>
                    <option>XAF - CFA Franc BEAC - FCFA</option>
                    <option>XPF - CFP Franc - ₣</option>
                    <option>CLP - Chilean Peso - $</option>
                    <option>CNY - Chinese Yuan - ¥</option>
                    <option>COP - Colombian Peso - $</option>
                    <option>KMF - Comorian Franc - CF</option>
                    <option>CDF - Congolese Franc - FC</option>
                    <option>CRC - Costa Rican ColÃ³n - ₡</option>
                    <option>HRK - Croatian Kuna - kn</option>
                    <option>CUC - Cuban Convertible Peso - $, CUC</option>
                    <option>CZK - Czech Republic Koruna - Kč</option>
                    <option>DKK - Danish Krone - Kr.</option>
                    <option>DJF - Djiboutian Franc - Fdj</option>
                    <option>DOP - Dominican Peso - $</option>
                    <option>XCD - East Caribbean Dollar - $</option>
                    <option>EGP - Egyptian Pound - ج.م</option>
                    <option>ERN - Eritrean Nakfa - Nfk</option>
                    <option>EEK - Estonian Kroon - kr</option>
                    <option>ETB - Ethiopian Birr - Nkf</option>
                    <option>EUR - Euro - €</option>
                    <option>FKP - Falkland Islands Pound - £</option>
                    <option>FJD - Fijian Dollar - FJ$</option>
                    <option>GMD - Gambian Dalasi - D</option>
                    <option>GEL - Georgian Lari - ლ</option>
                    <option>DEM - German Mark - DM</option>
                    <option selected>GHS - Ghanaian Cedi - GH₵</option>
                    <option>GIP - Gibraltar Pound - £</option>
                    <option>GRD - Greek Drachma - ₯, Δρχ, Δρ</option>
                    <option>GTQ - Guatemalan Quetzal - Q</option>
                    <option>GNF - Guinean Franc - FG</option>
                    <option>GYD - Guyanaese Dollar - $</option>
                    <option>HTG - Haitian Gourde - G</option>
                    <option>HNL - Honduran Lempira - L</option>
                    <option>HKD - Hong Kong Dollar - $</option>
                    <option>HUF - Hungarian Forint - Ft</option>
                    <option>ISK - Icelandic KrÃ³na - kr</option>
                    <option>INR - Indian Rupee - ₹</option>
                    <option>IDR - Indonesian Rupiah - Rp</option>
                    <option>IRR - Iranian Rial - ﷼</option>
                    <option>IQD - Iraqi Dinar - د.ع</option>
                    <option>ILS - Israeli New Sheqel - ₪</option>
                    <option>ITL - Italian Lira - L,£</option>
                    <option>JMD - Jamaican Dollar - J$</option>
                    <option>JPY - Japanese Yen - ¥</option>
                    <option>JOD - Jordanian Dinar - ا.د</option>
                    <option>KZT - Kazakhstani Tenge - лв</option>
                    <option>KES - Kenyan Shilling - KSh</option>
                    <option>KWD - Kuwaiti Dinar - ك.د</option>
                    <option>KGS - Kyrgystani Som - лв</option>
                    <option>LAK - Laotian Kip - ₭</option>
                    <option>LVL - Latvian Lats - Ls</option>
                    <option>LBP - Lebanese Pound - £</option>
                    <option>LSL - Lesotho Loti - L</option>
                    <option>LRD - Liberian Dollar - $</option>
                    <option>LYD - Libyan Dinar - د.ل</option>
                    <option>LTL - Lithuanian Litas - Lt</option>
                    <option>MOP - Macanese Pataca - $</option>
                    <option>MKD - Macedonian Denar - ден</option>
                    <option>MGA - Malagasy Ariary - Ar</option>
                    <option>MWK - Malawian Kwacha - MK</option>
                    <option>MYR - Malaysian Ringgit - RM</option>
                    <option>MVR - Maldivian Rufiyaa - Rf</option>
                    <option>MRO - Mauritanian Ouguiya - MRU</option>
                    <option>MUR - Mauritian Rupee - ₨</option>
                    <option>MXN - Mexican Peso - $</option>
                    <option>MDL - Moldovan Leu - L</option>
                    <option>MNT - Mongolian Tugrik - ₮</option>
                    <option>MAD - Moroccan Dirham - MAD</option>
                    <option>MZM - Mozambican Metical - MT</option>
                    <option>MMK - Myanmar Kyat - K</option>
                    <option>NAD - Namibian Dollar - $</option>
                    <option>NPR - Nepalese Rupee - ₨</option>
                    <option>ANG - Netherlands Antillean Guilder - ƒ</option>
                    <option>TWD - New Taiwan Dollar - $</option>
                    <option>NZD - New Zealand Dollar - $</option>
                    <option>NIO - Nicaraguan CÃ³rdoba - C$</option>
                    <option>NGN - Nigerian Naira - ₦</option>
                    <option>KPW - North Korean Won - ₩</option>
                    <option>NOK - Norwegian Krone - kr</option>
                    <option>OMR - Omani Rial - .ع.ر</option>
                    <option>PKR - Pakistani Rupee - ₨</option>
                    <option>PAB - Panamanian Balboa - B/.</option>
                    <option>PGK - Papua New Guinean Kina - K</option>
                    <option>PYG - Paraguayan Guarani - ₲</option>
                    <option>PEN - Peruvian Nuevo Sol - S/.</option>
                    <option>PHP - Philippine Peso - ₱</option>
                    <option>PLN - Polish Zloty - zł</option>
                    <option>QAR - Qatari Rial - ق.ر</option>
                    <option>RON - Romanian Leu - lei</option>
                    <option>RUB - Russian Ruble - ₽</option>
                    <option>RWF - Rwandan Franc - FRw</option>
                    <option>SVC - Salvadoran ColÃ³n - ₡</option>
                    <option>WST - Samoan Tala - SAT</option>
                    <option>SAR - Saudi Riyal - ﷼</option>
                    <option>RSD - Serbian Dinar - din</option>
                    <option>SCR - Seychellois Rupee - SRe</option>
                    <option>SLL - Sierra Leonean Leone - Le</option>
                    <option>SGD - Singapore Dollar - $</option>
                    <option>SKK - Slovak Koruna - Sk</option>
                    <option>SBD - Solomon Islands Dollar - Si$</option>
                    <option>SOS - Somali Shilling - Sh.so.</option>
                    <option>ZAR - South African Rand - R</option>
                    <option>KRW - South Korean Won - ₩</option>
                    <option>XDR - Special Drawing Rights - SDR</option>
                    <option>LKR - Sri Lankan Rupee - Rs</option>
                    <option>SHP - St. Helena Pound - £</option>
                    <option>SDG - Sudanese Pound - .س.ج</option>
                    <option>SRD - Surinamese Dollar - $</option>
                    <option>SZL - Swazi Lilangeni - E</option>
                    <option>SEK - Swedish Krona - kr</option>
                    <option>CHF - Swiss Franc - CHf</option>
                    <option>SYP - Syrian Pound - LS</option>
                    <option>STD - São Tomé and Príncipe Dobra - Db</option>
                    <option>TJS - Tajikistani Somoni - SM</option>
                    <option>TZS - Tanzanian Shilling - TSh</option>
                    <option>THB - Thai Baht - ฿</option>
                    <option>TOP - Tongan pa'anga - $</option>
                    <option>TTD - Trinidad & Tobago Dollar - $</option>
                    <option>TND - Tunisian Dinar - ت.د</option>
                    <option>TRY - Turkish Lira - ₺</option>
                    <option>TMT - Turkmenistani Manat - T</option>
                    <option>UGX - Ugandan Shilling - USh</option>
                    <option>UAH - Ukrainian Hryvnia - ₴</option>
                    <option>AED - United Arab Emirates Dirham - إ.د</option>
                    <option>UYU - Uruguayan Peso - $</option>
                    <option>USD - US Dollar - $</option>
                    <option>UZS - Uzbekistan Som - лв</option>
                    <option>VUV - Vanuatu Vatu - VT</option>
                    <option>VEF - Venezuelan BolÃ­var - Bs</option>
                    <option>VND - Vietnamese Dong - ₫</option>
                    <option>YER - Yemeni Rial - ﷼</option>
                    <option>ZMK - Zambian Kwacha - ZK</option>
                </select>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please select currency</div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="d-block form-label" for="address">Address</label>
                <textarea class="form-control" id="address" rows="3" required><?php echo $resdetails['address']; ?></textarea>
                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter your address.</div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="logo">Logo</label>
                <input id="file_upload" type="file" multiple="false" />
                <div id="queue"></div>
                <div class="profile-img mt-1">
                    <img src="<?php echo $resdetails['logo'];
                                ?>" style="width:50%" class="rounded img-fluid" alt="User image">
                </div>
                <input type="hidden" id="selected" />

                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Please enter tagline</div>
            </div>
        </div>

    </div>

    <button type="button" id="configbtn" class="btn btn-primary">Update</button>
</form>


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


    $("#currency").select2({
        placeholder: "Select Currency",
        allowClear: true
    });


    // Add action on form submit
    $("#configbtn").click(function() {

        var companyname = $("#companyname").val();
        var tagline = $("#tagline").val();
        var telephone = $("#telephone").val();
        var currency = $("#currency").val();
        var address = $("#address").val();
        var address = $("#address").val();
        var emailaddress = $("#emailaddress").val();
        var whatsapp = $("#whatsapp").val();
        var sysconid = '<?php echo $random; ?>';
        var theid = '<?php echo $theid ?>';

        var error = '';

        if (companyname == "") {
            error += "Please enter company's name \n";
            $("#companyname").focus();
        }
        if (tagline == "") {
            error += 'Please enter company tagline \n';
            $("#tagline").focus();
        }
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


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/edit/systemconfig.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    companyname: companyname,
                    tagline: tagline,
                    telephone: telephone,
                    emailaddress: emailaddress,
                    whatsapp: whatsapp,
                    currency: currency,
                    address: address,
                    sysconid: sysconid,
                    theid: theid
                },
                success: function(text) {
                    $('#file_upload').uploadifive('upload');
                    //alert(text);
                    location.reload();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function() {
                    $.unblockUI();
                },
            });
        } else {
            $("#error_loc").notify(error);
        }
        return false;

    });
>>>>>>> cc8672cb579107911adae15ecf1f69a6ab81ea13
</script>