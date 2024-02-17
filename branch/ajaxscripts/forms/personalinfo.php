<?php
include('../../../config.php');
$random = rand(1, 10) . date("Y-m-d");
$branch = $_SESSION['branch'];
?>

<style>
    .requiredtext {
        font-size: 11px;
        margin-bottom: 10px;
    }

    .required {
        color: red
    }

    body {
        overflow-x: hidden !important;
    }
</style>

<label class="requiredtext">Field marked <span class="required"> * </span> are required</label>
<form autocomplete="off">

    <div class="row">
        <div class="mb-1 col-md-4">
            <label class="form-label" for="fullname">Full Name <span class="required"> * </span></label>
            <input type="text" id="fullname" class="form-control" placeholder="Full Name" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="maidenname">Maiden Name</label>
            <input type="text" id="maidenname" class="form-control" placeholder="Maiden Name" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="telephone">Telephone</label>
            <input type="number" id="telephone" class="form-control" placeholder="Telephone" />
        </div>

    </div>

    <div class="row">
        <div class="mb-1 col-md-4">
            <label class="form-label" for="dob">Date of Birth <span class="required"> * </span></label>
            <input type="text" id="dob" class="form-control" placeholder="Date of Birth" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="age">Age (auto generated)</label>
            <input type="text" id="age" class="form-control" placeholder="Age" readonly />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="birthplace">Place of Birth <span class="required"> * </span></label>
            <input type="text" id="birthplace" class="form-control" placeholder="Place of Birth" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-4">
            <label class="form-label">Gender <span class="required"> * </span></label> <br />
            <div>
                <span>
                    <input class="form-check-input" type="radio" name="gender" id="female" value="Male">
                    <label class="form-check-label" for="male">Male</label>
                </span>
                <span style="margin-left: 20px;">
                    <input class="form-check-input ml-4" type="radio" name="gender" id="female" value="Female">
                    <label class="form-check-label" for="female">Female</label>
                </span>
            </div>
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="gpsaddress">GPS Address</label>
            <input type="text" id="gpsaddress" class="form-control" placeholder="GPS Address" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="location">Location <span class="required"> * </span></label>
            <input type="text" id="location" class="form-control" placeholder="Location" />
        </div>
    </div>

    <div class="row">

        <div class="mb-1 col-md-4">
            <label class="form-label" for="hometown">Hometown <span class="required"> * </span></label>
            <input type="text" id="hometown" class="form-control" placeholder="Hometown" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="location">Nationality <span class="required"> * </span></label>
            <select data-placeholder="Select Nationality" id="nationality" style="width: 100%" class="select2 form-select">
                <option></option>
                <option <?php if (@$re_profile['nationality'] == "Afghanistan") echo "Selected" ?>>Afghanistan</option>
                <option <?php if (@$re_profile['nationality'] == "Åland Islands") echo "Selected" ?>>Åland Islands</option>
                <option <?php if (@$re_profile['nationality'] == "Albania") echo "Selected" ?>>Albania</option>
                <option <?php if (@$re_profile['nationality'] == "Algeria") echo "Selected" ?>>Algeria</option>
                <option <?php if (@$re_profile['nationality'] == "American Samoa") echo "Selected" ?>>American Samoa</option>
                <option <?php if (@$re_profile['nationality'] == "Andorra") echo "Selected" ?>>Andorra</option>
                <option <?php if (@$re_profile['nationality'] == "Angola") echo "Selected" ?>>Angola</option>
                <option <?php if (@$re_profile['nationality'] == "Anguilla") echo "Selected" ?>>Anguilla</option>
                <option <?php if (@$re_profile['nationality'] == "Antarctica") echo "Selected" ?>>Antarctica</option>
                <option <?php if (@$re_profile['nationality'] == "Antigua and Barbuda") echo "Selected" ?>>Antigua and Barbuda</option>
                <option <?php if (@$re_profile['nationality'] == "Argentina") echo "Selected" ?>>Argentina</option>
                <option <?php if (@$re_profile['nationality'] == "Armenia") echo "Selected" ?>>Armenia</option>
                <option <?php if (@$re_profile['nationality'] == "Aruba") echo "Selected" ?>>Aruba</option>
                <option <?php if (@$re_profile['nationality'] == "Australia") echo "Selected" ?>>Australia</option>
                <option <?php if (@$re_profile['nationality'] == "Austria") echo "Selected" ?>>Austria</option>
                <option <?php if (@$re_profile['nationality'] == "Azerbaijan") echo "Selected" ?>>Azerbaijan</option>
                <option <?php if (@$re_profile['nationality'] == "Bahamas") echo "Selected" ?>>Bahamas</option>
                <option <?php if (@$re_profile['nationality'] == "Bahrain") echo "Selected" ?>>Bahrain</option>
                <option <?php if (@$re_profile['nationality'] == "Bangladesh") echo "Selected" ?>>Bangladesh</option>
                <option <?php if (@$re_profile['nationality'] == "Barbados") echo "Selected" ?>>Barbados</option>
                <option <?php if (@$re_profile['nationality'] == "Belarus") echo "Selected" ?>>Belarus</option>
                <option <?php if (@$re_profile['nationality'] == "Belgium") echo "Selected" ?>>Belgium</option>
                <option <?php if (@$re_profile['nationality'] == "Belize") echo "Selected" ?>>Belize</option>
                <option <?php if (@$re_profile['nationality'] == "Benin") echo "Selected" ?>>Benin</option>
                <option <?php if (@$re_profile['nationality'] == "Bermuda") echo "Selected" ?>>Bermuda</option>
                <option <?php if (@$re_profile['nationality'] == "Bhutan") echo "Selected" ?>>Bhutan</option>
                <option <?php if (@$re_profile['nationality'] == "Bolivia") echo "Selected" ?>>Bolivia</option>
                <option <?php if (@$re_profile['nationality'] == "Bosnia and Herzegovina") echo "Selected" ?>>Bosnia and Herzegovina</option>
                <option <?php if (@$re_profile['nationality'] == "Botswana") echo "Selected" ?>>Botswana</option>
                <option <?php if (@$re_profile['nationality'] == "Bouvet Island") echo "Selected" ?>>Bouvet Island</option>
                <option <?php if (@$re_profile['nationality'] == "Brazil") echo "Selected" ?>>Brazil</option>
                <option <?php if (@$re_profile['nationality'] == "British Indian Ocean Territory") echo "Selected" ?>>British Indian Ocean Territory</option>
                <option <?php if (@$re_profile['nationality'] == "Brunei Darussalam") echo "Selected" ?>>Brunei Darussalam</option>
                <option <?php if (@$re_profile['nationality'] == "Bulgaria") echo "Selected" ?>>Bulgaria</option>
                <option <?php if (@$re_profile['nationality'] == "Burkina Faso") echo "Selected" ?>>Burkina Faso</option>
                <option <?php if (@$re_profile['nationality'] == "Burundi") echo "Selected" ?>>Burundi</option>
                <option <?php if (@$re_profile['nationality'] == "Cambodia") echo "Selected" ?>>Cambodia</option>
                <option <?php if (@$re_profile['nationality'] == "Cameroon") echo "Selected" ?>>Cameroon</option>
                <option <?php if (@$re_profile['nationality'] == "Canada") echo "Selected" ?>>Canada</option>
                <option <?php if (@$re_profile['nationality'] == "Cape Verde") echo "Selected" ?>>Cape Verde</option>
                <option <?php if (@$re_profile['nationality'] == "Cayman Islands") echo "Selected" ?>>Cayman Islands</option>
                <option <?php if (@$re_profile['nationality'] == "Central African Republic") echo "Selected" ?>>Central African Republic</option>
                <option <?php if (@$re_profile['nationality'] == "Chad") echo "Selected" ?>>Chad</option>
                <option <?php if (@$re_profile['nationality'] == "Chile") echo "Selected" ?>>Chile</option>
                <option <?php if (@$re_profile['nationality'] == "China") echo "Selected" ?>>China</option>
                <option <?php if (@$re_profile['nationality'] == "Christmas Island") echo "Selected" ?>>Christmas Island</option>
                <option <?php if (@$re_profile['nationality'] == "Cocos (Keeling) Islands") echo "Selected" ?>>Cocos (Keeling) Islands</option>
                <option <?php if (@$re_profile['nationality'] == "Colombia") echo "Selected" ?>>Colombia</option>
                <option <?php if (@$re_profile['nationality'] == "Comoros") echo "Selected" ?>>Comoros</option>
                <option <?php if (@$re_profile['nationality'] == "Congo") echo "Selected" ?>>Congo</option>
                <option <?php if (@$re_profile['nationality'] == "Congo, The Democratic Republic of The") echo "Selected" ?>>Congo, The Democratic Republic of The</option>
                <option <?php if (@$re_profile['nationality'] == "Cook Islands") echo "Selected" ?>>Cook Islands</option>
                <option <?php if (@$re_profile['nationality'] == "Costa Rica") echo "Selected" ?>>Costa Rica</option>
                <option <?php if (@$re_profile['nationality'] == "Cote D'ivoire") echo "Selected" ?>>Cote D'ivoire</option>
                <option <?php if (@$re_profile['nationality'] == "Croatia") echo "Selected" ?>>Croatia</option>
                <option <?php if (@$re_profile['nationality'] == "Cuba") echo "Selected" ?>>Cuba</option>
                <option <?php if (@$re_profile['nationality'] == "Cyprus") echo "Selected" ?>>Cyprus</option>
                <option <?php if (@$re_profile['nationality'] == "Czech Republic") echo "Selected" ?>>Czech Republic</option>
                <option <?php if (@$re_profile['nationality'] == "Denmark") echo "Selected" ?>>Denmark</option>
                <option <?php if (@$re_profile['nationality'] == "Djibouti") echo "Selected" ?>>Djibouti</option>
                <option <?php if (@$re_profile['nationality'] == "Dominica") echo "Selected" ?>>Dominica</option>
                <option <?php if (@$re_profile['nationality'] == "Dominican Republic") echo "Selected" ?>>Dominican Republic</option>
                <option <?php if (@$re_profile['nationality'] == "Ecuador") echo "Selected" ?>>Ecuador</option>
                <option <?php if (@$re_profile['nationality'] == "Egypt") echo "Selected" ?>>Egypt</option>
                <option <?php if (@$re_profile['nationality'] == "El Salvador") echo "Selected" ?>>El Salvador</option>
                <option <?php if (@$re_profile['nationality'] == "Equatorial Guinea") echo "Selected" ?>>Equatorial Guinea</option>
                <option <?php if (@$re_profile['nationality'] == "Eritrea") echo "Selected" ?>>Eritrea</option>
                <option <?php if (@$re_profile['nationality'] == "Estonia") echo "Selected" ?>>Estonia</option>
                <option <?php if (@$re_profile['nationality'] == "Ethiopia") echo "Selected" ?>>Ethiopia</option>
                <option <?php if (@$re_profile['nationality'] == "Falkland Islands (Malvinas)") echo "Selected" ?>>Falkland Islands (Malvinas)</option>
                <option <?php if (@$re_profile['nationality'] == "Faroe Islands") echo "Selected" ?>>Faroe Islands</option>
                <option <?php if (@$re_profile['nationality'] == "Fiji") echo "Selected" ?>>Fiji</option>
                <option <?php if (@$re_profile['nationality'] == "Finland") echo "Selected" ?>>Finland</option>
                <option <?php if (@$re_profile['nationality'] == "France") echo "Selected" ?>>France</option>
                <option <?php if (@$re_profile['nationality'] == "French Guiana") echo "Selected" ?>>French Guiana</option>
                <option <?php if (@$re_profile['nationality'] == "French Polynesia") echo "Selected" ?>>French Polynesia</option>
                <option <?php if (@$re_profile['nationality'] == "French Southern Territories") echo "Selected" ?>>French Southern Territories</option>
                <option <?php if (@$re_profile['nationality'] == "Gabon") echo "Selected" ?>>Gabon</option>
                <option <?php if (@$re_profile['nationality'] == "Gambia") echo "Selected" ?>>Gambia</option>
                <option <?php if (@$re_profile['nationality'] == "Georgia") echo "Selected" ?>>Georgia</option>
                <option <?php if (@$re_profile['nationality'] == "Germany") echo "Selected" ?>>Germany</option>
                <option <?php if (@$re_profile['nationality'] == "Ghana") echo "Selected" ?>>Ghana</option>
                <option <?php if (@$re_profile['nationality'] == "Gibraltar") echo "Selected" ?>>Gibraltar</option>
                <option <?php if (@$re_profile['nationality'] == "Greece") echo "Selected" ?>>Greece</option>
                <option <?php if (@$re_profile['nationality'] == "Greenland") echo "Selected" ?>>Greenland</option>
                <option <?php if (@$re_profile['nationality'] == "Grenada") echo "Selected" ?>>Grenada</option>
                <option <?php if (@$re_profile['nationality'] == "Guadeloupe") echo "Selected" ?>>Guadeloupe</option>
                <option <?php if (@$re_profile['nationality'] == "Guam") echo "Selected" ?>>Guam</option>
                <option <?php if (@$re_profile['nationality'] == "Guatemala") echo "Selected" ?>>Guatemala</option>
                <option <?php if (@$re_profile['nationality'] == "Guernsey") echo "Selected" ?>>Guernsey</option>
                <option <?php if (@$re_profile['nationality'] == "Guinea") echo "Selected" ?>>Guinea</option>
                <option <?php if (@$re_profile['nationality'] == "Guinea-bissau") echo "Selected" ?>>Guinea-bissau</option>
                <option <?php if (@$re_profile['nationality'] == "Guyana") echo "Selected" ?>>Guyana</option>
                <option <?php if (@$re_profile['nationality'] == "Haiti") echo "Selected" ?>>Haiti</option>
                <option <?php if (@$re_profile['nationality'] == "Heard Island and Mcdonald Islands") echo "Selected" ?>>Heard Island and Mcdonald Islands</option>
                <option <?php if (@$re_profile['nationality'] == "Holy See (Vatican City State)") echo "Selected" ?>>Holy See (Vatican City State)</option>
                <option <?php if (@$re_profile['nationality'] == "Honduras") echo "Selected" ?>>Honduras</option>
                <option <?php if (@$re_profile['nationality'] == "Hong Kong") echo "Selected" ?>>Hong Kong</option>
                <option <?php if (@$re_profile['nationality'] == "Hungary") echo "Selected" ?>>Hungary</option>
                <option <?php if (@$re_profile['nationality'] == "Iceland") echo "Selected" ?>>Iceland</option>
                <option <?php if (@$re_profile['nationality'] == "India") echo "Selected" ?>>India</option>
                <option <?php if (@$re_profile['nationality'] == "Indonesia") echo "Selected" ?>>Indonesia</option>
                <option <?php if (@$re_profile['nationality'] == "Iran, Islamic Republic of") echo "Selected" ?>>Iran, Islamic Republic of</option>
                <option <?php if (@$re_profile['nationality'] == "Iraq") echo "Selected" ?>>Iraq</option>
                <option <?php if (@$re_profile['nationality'] == "Ireland") echo "Selected" ?>>Ireland</option>
                <option <?php if (@$re_profile['nationality'] == "Isle of Man") echo "Selected" ?>>Isle of Man</option>
                <option <?php if (@$re_profile['nationality'] == "Israel") echo "Selected" ?>>Israel</option>
                <option <?php if (@$re_profile['nationality'] == "Italy") echo "Selected" ?>>Italy</option>
                <option <?php if (@$re_profile['nationality'] == "Jamaica") echo "Selected" ?>>Jamaica</option>
                <option <?php if (@$re_profile['nationality'] == "Japan") echo "Selected" ?>>Japan</option>
                <option <?php if (@$re_profile['nationality'] == "Jersey") echo "Selected" ?>>Jersey</option>
                <option <?php if (@$re_profile['nationality'] == "Jordan") echo "Selected" ?>>Jordan</option>
                <option <?php if (@$re_profile['nationality'] == "Kazakhstan") echo "Selected" ?>>Kazakhstan</option>
                <option <?php if (@$re_profile['nationality'] == "Kenya") echo "Selected" ?>>Kenya</option>
                <option <?php if (@$re_profile['nationality'] == "Kiribati") echo "Selected" ?>>Kiribati</option>
                <option <?php if (@$re_profile['nationality'] == "Korea, Democratic People's Republic of") echo "Selected" ?>>Korea, Democratic People's Republic of</option>
                <option <?php if (@$re_profile['nationality'] == "Korea, Republic of") echo "Selected" ?>>Korea, Republic of</option>
                <option <?php if (@$re_profile['nationality'] == "Kuwait") echo "Selected" ?>>Kuwait</option>
                <option <?php if (@$re_profile['nationality'] == "Kyrgyzstan") echo "Selected" ?>>Kyrgyzstan</option>
                <option <?php if (@$re_profile['nationality'] == "Lao People's Democratic Republic") echo "Selected" ?>>Lao People's Democratic Republic</option>
                <option <?php if (@$re_profile['nationality'] == "Latvia") echo "Selected" ?>>Latvia</option>
                <option <?php if (@$re_profile['nationality'] == "Lebanon") echo "Selected" ?>>Lebanon</option>
                <option <?php if (@$re_profile['nationality'] == "Lesotho") echo "Selected" ?>>Lesotho</option>
                <option <?php if (@$re_profile['nationality'] == "Liberia") echo "Selected" ?>>Liberia</option>
                <option <?php if (@$re_profile['nationality'] == "Libyan Arab Jamahiriya") echo "Selected" ?>>Libyan Arab Jamahiriya</option>
                <option <?php if (@$re_profile['nationality'] == "Liechtenstein") echo "Selected" ?>>Liechtenstein</option>
                <option <?php if (@$re_profile['nationality'] == "Lithuania") echo "Selected" ?>>Lithuania</option>
                <option <?php if (@$re_profile['nationality'] == "Luxembourg") echo "Selected" ?>>Luxembourg</option>
                <option <?php if (@$re_profile['nationality'] == "Macao") echo "Selected" ?>>Macao</option>
                <option <?php if (@$re_profile['nationality'] == "Macedonia, The Former Yugoslav Republic of") echo "Selected" ?>>Macedonia, The Former Yugoslav Republic of</option>
                <option <?php if (@$re_profile['nationality'] == "Madagascar") echo "Selected" ?>>Madagascar</option>
                <option <?php if (@$re_profile['nationality'] == "Malawi") echo "Selected" ?>>Malawi</option>
                <option <?php if (@$re_profile['nationality'] == "Malaysia") echo "Selected" ?>>Malaysia</option>
                <option <?php if (@$re_profile['nationality'] == "Maldives") echo "Selected" ?>>Maldives</option>
                <option <?php if (@$re_profile['nationality'] == "Mali") echo "Selected" ?>>Mali</option>
                <option <?php if (@$re_profile['nationality'] == "Malta") echo "Selected" ?>>Malta</option>
                <option <?php if (@$re_profile['nationality'] == "Marshall Islands") echo "Selected" ?>>Marshall Islands</option>
                <option <?php if (@$re_profile['nationality'] == "Martinique") echo "Selected" ?>>Martinique</option>
                <option <?php if (@$re_profile['nationality'] == "Mauritania") echo "Selected" ?>>Mauritania</option>
                <option <?php if (@$re_profile['nationality'] == "Mauritius") echo "Selected" ?>>Mauritius</option>
                <option <?php if (@$re_profile['nationality'] == "Mayotte") echo "Selected" ?>>Mayotte</option>
                <option <?php if (@$re_profile['nationality'] == "Mexico") echo "Selected" ?>>Mexico</option>
                <option <?php if (@$re_profile['nationality'] == "Micronesia, Federated States of") echo "Selected" ?>>Micronesia, Federated States of</option>
                <option <?php if (@$re_profile['nationality'] == "Moldova, Republic of") echo "Selected" ?>>Moldova, Republic of</option>
                <option <?php if (@$re_profile['nationality'] == "Monaco") echo "Selected" ?>>Monaco</option>
                <option <?php if (@$re_profile['nationality'] == "Mongolia") echo "Selected" ?>>Mongolia</option>
                <option <?php if (@$re_profile['nationality'] == "Montenegro") echo "Selected" ?>>Montenegro</option>
                <option <?php if (@$re_profile['nationality'] == "Montserrat") echo "Selected" ?>>Montserrat</option>
                <option <?php if (@$re_profile['nationality'] == "Morocco") echo "Selected" ?>>Morocco</option>
                <option <?php if (@$re_profile['nationality'] == "Mozambique") echo "Selected" ?>>Mozambique</option>
                <option <?php if (@$re_profile['nationality'] == "Myanmar") echo "Selected" ?>>Myanmar</option>
                <option <?php if (@$re_profile['nationality'] == "Namibia") echo "Selected" ?>>Namibia</option>
                <option <?php if (@$re_profile['nationality'] == "Nauru") echo "Selected" ?>>Nauru</option>
                <option <?php if (@$re_profile['nationality'] == "Nepal") echo "Selected" ?>>Nepal</option>
                <option <?php if (@$re_profile['nationality'] == "Netherlands") echo "Selected" ?>>Netherlands</option>
                <option <?php if (@$re_profile['nationality'] == "Netherlands Antilles") echo "Selected" ?>>Netherlands Antilles</option>
                <option <?php if (@$re_profile['nationality'] == "New Caledonia") echo "Selected" ?>>New Caledonia</option>
                <option <?php if (@$re_profile['nationality'] == "New Zealand") echo "Selected" ?>>New Zealand</option>
                <option <?php if (@$re_profile['nationality'] == "Nicaragua") echo "Selected" ?>>Nicaragua</option>
                <option <?php if (@$re_profile['nationality'] == "Niger") echo "Selected" ?>>Niger</option>
                <option <?php if (@$re_profile['nationality'] == "Nigeria") echo "Selected" ?>>Nigeria</option>
                <option <?php if (@$re_profile['nationality'] == "Niue") echo "Selected" ?>>Niue</option>
                <option <?php if (@$re_profile['nationality'] == "Norfolk Island") echo "Selected" ?>>Norfolk Island</option>
                <option <?php if (@$re_profile['nationality'] == "Northern Mariana Islands") echo "Selected" ?>>Northern Mariana Islands</option>
                <option <?php if (@$re_profile['nationality'] == "Norway") echo "Selected" ?>>Norway</option>
                <option <?php if (@$re_profile['nationality'] == "Oman") echo "Selected" ?>>Oman</option>
                <option <?php if (@$re_profile['nationality'] == "Pakistan") echo "Selected" ?>>Pakistan</option>
                <option <?php if (@$re_profile['nationality'] == "Palau") echo "Selected" ?>>Palau</option>
                <option <?php if (@$re_profile['nationality'] == "Palestinian Territory, Occupied") echo "Selected" ?>>Palestinian Territory, Occupied</option>
                <option <?php if (@$re_profile['nationality'] == "Panama") echo "Selected" ?>>Panama</option>
                <option <?php if (@$re_profile['nationality'] == "Papua New Guinea") echo "Selected" ?>>Papua New Guinea</option>
                <option <?php if (@$re_profile['nationality'] == "Paraguay") echo "Selected" ?>>Paraguay</option>
                <option <?php if (@$re_profile['nationality'] == "Peru") echo "Selected" ?>>Peru</option>
                <option <?php if (@$re_profile['nationality'] == "Philippines") echo "Selected" ?>>Philippines</option>
                <option <?php if (@$re_profile['nationality'] == "Pitcairn") echo "Selected" ?>>Pitcairn</option>
                <option <?php if (@$re_profile['nationality'] == "Poland") echo "Selected" ?>>Poland</option>
                <option <?php if (@$re_profile['nationality'] == "Portugal") echo "Selected" ?>>Portugal</option>
                <option <?php if (@$re_profile['nationality'] == "Puerto Rico") echo "Selected" ?>>Puerto Rico</option>
                <option <?php if (@$re_profile['nationality'] == "Qatar") echo "Selected" ?>>Qatar</option>
                <option <?php if (@$re_profile['nationality'] == "Reunion") echo "Selected" ?>>Reunion</option>
                <option <?php if (@$re_profile['nationality'] == "Romania") echo "Selected" ?>>Romania</option>
                <option <?php if (@$re_profile['nationality'] == "Russian Federation") echo "Selected" ?>>Russian Federation</option>
                <option <?php if (@$re_profile['nationality'] == "Rwanda") echo "Selected" ?>>Rwanda</option>
                <option <?php if (@$re_profile['nationality'] == "Saint Helena") echo "Selected" ?>>Saint Helena</option>
                <option <?php if (@$re_profile['nationality'] == "Saint Kitts and Nevis") echo "Selected" ?>>Saint Kitts and Nevis</option>
                <option <?php if (@$re_profile['nationality'] == "Saint Lucia") echo "Selected" ?>>Saint Lucia</option>
                <option <?php if (@$re_profile['nationality'] == "Saint Pierre and Miquelon") echo "Selected" ?>>Saint Pierre and Miquelon</option>
                <option <?php if (@$re_profile['nationality'] == "Saint Vincent and The Grenadines") echo "Selected" ?>>Saint Vincent and The Grenadines</option>
                <option <?php if (@$re_profile['nationality'] == "Samoa") echo "Selected" ?>>Samoa</option>
                <option <?php if (@$re_profile['nationality'] == "San Marino") echo "Selected" ?>>San Marino</option>
                <option <?php if (@$re_profile['nationality'] == "Sao Tome and Principe") echo "Selected" ?>>Sao Tome and Principe</option>
                <option <?php if (@$re_profile['nationality'] == "Saudi Arabia") echo "Selected" ?>>Saudi Arabia</option>
                <option <?php if (@$re_profile['nationality'] == "Senegal") echo "Selected" ?>>Senegal</option>
                <option <?php if (@$re_profile['nationality'] == "Serbia") echo "Selected" ?>>Serbia</option>
                <option <?php if (@$re_profile['nationality'] == "Seychelles") echo "Selected" ?>>Seychelles</option>
                <option <?php if (@$re_profile['nationality'] == "Sierra Leone") echo "Selected" ?>>Sierra Leone</option>
                <option <?php if (@$re_profile['nationality'] == "Singapore") echo "Selected" ?>>Singapore</option>
                <option <?php if (@$re_profile['nationality'] == "Slovakia") echo "Selected" ?>>Slovakia</option>
                <option <?php if (@$re_profile['nationality'] == "Slovenia") echo "Selected" ?>>Slovenia</option>
                <option <?php if (@$re_profile['nationality'] == "Solomon Islands") echo "Selected" ?>>Solomon Islands</option>
                <option <?php if (@$re_profile['nationality'] == "Somalia") echo "Selected" ?>>Somalia</option>
                <option <?php if (@$re_profile['nationality'] == "South Africa") echo "Selected" ?>>South Africa</option>
                <option <?php if (@$re_profile['nationality'] == "South Georgia and The South Sandwich Islands") echo "Selected" ?>>South Georgia and The South Sandwich Islands</option>
                <option <?php if (@$re_profile['nationality'] == "Spain") echo "Selected" ?>>Spain</option>
                <option <?php if (@$re_profile['nationality'] == "Sri Lanka") echo "Selected" ?>>Sri Lanka</option>
                <option <?php if (@$re_profile['nationality'] == "Sudan") echo "Selected" ?>>Sudan</option>
                <option <?php if (@$re_profile['nationality'] == "Suriname") echo "Selected" ?>>Suriname</option>
                <option <?php if (@$re_profile['nationality'] == "Svalbard and Jan Mayen") echo "Selected" ?>>Svalbard and Jan Mayen</option>
                <option <?php if (@$re_profile['nationality'] == "Swaziland") echo "Selected" ?>>Swaziland</option>
                <option <?php if (@$re_profile['nationality'] == "Sweden") echo "Selected" ?>>Sweden</option>
                <option <?php if (@$re_profile['nationality'] == "Switzerland") echo "Selected" ?>>Switzerland</option>
                <option <?php if (@$re_profile['nationality'] == "Syrian Arab Republic") echo "Selected" ?>>Syrian Arab Republic</option>
                <option <?php if (@$re_profile['nationality'] == "Taiwan") echo "Selected" ?>>Taiwan</option>
                <option <?php if (@$re_profile['nationality'] == "Tajikistan") echo "Selected" ?>>Tajikistan</option>
                <option <?php if (@$re_profile['nationality'] == "Tanzania, United Republic of") echo "Selected" ?>>Tanzania, United Republic of</option>
                <option <?php if (@$re_profile['nationality'] == "Thailand") echo "Selected" ?>>Thailand</option>
                <option <?php if (@$re_profile['nationality'] == "Timor-leste") echo "Selected" ?>>Timor-leste</option>
                <option <?php if (@$re_profile['nationality'] == "Togo") echo "Selected" ?>>Togo</option>
                <option <?php if (@$re_profile['nationality'] == "Tokelau") echo "Selected" ?>>Tokelau</option>
                <option <?php if (@$re_profile['nationality'] == "Tonga") echo "Selected" ?>>Tonga</option>
                <option <?php if (@$re_profile['nationality'] == "Trinidad and Tobago") echo "Selected" ?>>Trinidad and Tobago</option>
                <option <?php if (@$re_profile['nationality'] == "Tunisia") echo "Selected" ?>>Tunisia</option>
                <option <?php if (@$re_profile['nationality'] == "Turkey") echo "Selected" ?>>Turkey</option>
                <option <?php if (@$re_profile['nationality'] == "Turkmenistan") echo "Selected" ?>>Turkmenistan</option>
                <option <?php if (@$re_profile['nationality'] == "Turks and Caicos Islands") echo "Selected" ?>>Turks and Caicos Islands</option>
                <option <?php if (@$re_profile['nationality'] == "Tuvalu") echo "Selected" ?>>Tuvalu</option>
                <option <?php if (@$re_profile['nationality'] == "Uganda") echo "Selected" ?>>Uganda</option>
                <option <?php if (@$re_profile['nationality'] == "Ukraine") echo "Selected" ?>>Ukraine</option>
                <option <?php if (@$re_profile['nationality'] == "United Arab Emirates") echo "Selected" ?>>United Arab Emirates</option>
                <option <?php if (@$re_profile['nationality'] == "United Kingdom") echo "Selected" ?>>United Kingdom</option>
                <option <?php if (@$re_profile['nationality'] == "United States") echo "Selected" ?>>United States</option>
                <option <?php if (@$re_profile['nationality'] == "United States Minor Outlying Islands") echo "Selected" ?>>United States Minor Outlying Islands</option>
                <option <?php if (@$re_profile['nationality'] == "Uruguay") echo "Selected" ?>>Uruguay</option>
                <option <?php if (@$re_profile['nationality'] == "Uzbekistan") echo "Selected" ?>>Uzbekistan</option>
                <option <?php if (@$re_profile['nationality'] == "Vanuatu") echo "Selected" ?>>Vanuatu</option>
                <option <?php if (@$re_profile['nationality'] == "Venezuela") echo "Selected" ?>>Venezuela</option>
                <option <?php if (@$re_profile['nationality'] == "Viet Nam") echo "Selected" ?>>Viet Nam</option>
                <option <?php if (@$re_profile['nationality'] == "Virgin Islands, British") echo "Selected" ?>>Virgin Islands, British</option>
                <option <?php if (@$re_profile['nationality'] == "Virgin Islands, U.S.") echo "Selected" ?>>Virgin Islands, U.S.</option>
                <option <?php if (@$re_profile['nationality'] == "Wallis and Futuna") echo "Selected" ?>>Wallis and Futuna</option>
                <option <?php if (@$re_profile['nationality'] == "Western Sahara") echo "Selected" ?>>Western Sahara</option>
                <option <?php if (@$re_profile['nationality'] == "Yemen") echo "Selected" ?>>Yemen</option>
                <option <?php if (@$re_profile['nationality'] == "Zambia") echo "Selected" ?>>Zambia</option>
                <option <?php if (@$re_profile['nationality'] == "Zimbabwe") echo "Selected" ?>>Zimbabwe</option>
            </select>
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label">Communicant <span class="required"> * </span></label> <br />
            <div>
                <span>
                    <input class="form-check-input" type="radio" name="communicant" id="communicantyes" value="Yes">
                    <label class="form-check-label" for="communicantyes">Yes</label>
                </span>
                <span style="margin-left: 20px;">
                    <input class="form-check-input ml-4" type="radio" name="communicant" id="communicantno" value="No">
                    <label class="form-check-label" for="communicantno">No</label>
                </span>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="mb-1 col-md-4">
            <label class="form-label" for="baptismdate">Baptism Date</label>
            <input type="text" id="baptismdate" class="form-control" placeholder="Baptism Date" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="confirmationdate">Confirmation Date/Place</label>
            <input type="text" id="confirmationdate" class="form-control" placeholder="Confirmation Date/Place" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="emailaddress">Email Address</label>
            <input type="text" id="emailaddress" class="form-control" placeholder="Email Address" />
        </div>
    </div>

    <div class="row">

        <div class="mb-1 col-md-4">
            <label class="form-label" for="placeofwork">Place of Work</label>
            <input type="text" id="placeofwork" class="form-control" placeholder="Place of Work" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="society">Society</label>
            <select class="form-select" id="society">
                <option></option>
                <?php
                $getsociety = $mysqli->query("select * from ministry where branch = '$branch'");
                while ($ressociety = $getsociety->fetch_assoc()) { ?>
                    <option value="<?php echo $ressociety['id'] ?>"><?php echo $ressociety['ministry_name'] ?></option>
                <?php }
                ?>
            </select>
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="occupation">Occupation</label>
            <input type="text" id="occupation" class="form-control" placeholder="Occupation" />
        </div>
    </div>


    <div class="d-flex justify-content-between mt-2">
        <button class="btn btn-outline-secondary btn-prev waves-effect" disabled="">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left align-middle me-sm-25 me-0">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
        </button>
        <button id="personalinfobtn" class="btn btn-primary waves-effect waves-float waves-light">
            <span class="align-middle d-sm-inline-block d-none">Next</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right align-middle ms-sm-25 ms-0">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </button>
    </div>

</form>


<script>
    $("#dob").flatpickr();
    $("#baptismdate").flatpickr();

    $("#nationality").select2({
        placeholder: "Select Country",
        allowClear: true
    });

    $("#society").select2({
        placeholder: "Select Society",
        allowClear: true
    });


    // Function to calculate age based on date of birth
    function calculateAge(dob) {
        const today = new Date();
        const birthDate = new Date(dob);
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }

    // Event listener to calculate age when date of birth changes
    document.getElementById('dob').addEventListener('change', function() {
        const dob = this.value;
        const age = calculateAge(dob);
        document.getElementById('age').value = age;
    });


    function updateReadOnlyBox() {
        // Get the value from the inputBox
        var inputBoxValue = document.getElementById("sellingprice").value;

        // Parse the value as a number
        var numberValue = parseFloat(inputBoxValue);
        var costPrice = numberValue * 0.9;
        document.getElementById("costprice").value = isNaN(costPrice) ? "" : costPrice.toFixed(2);;
    }

    //PERSONAL INFORMATION
    $("#personalinfobtn").on("click", (function() {

        var fullname = $("#fullname").val();
        var maidenname = $("#maidenname").val();
        var telephone = $("#telephone").val();
        var dob = $("#dob").val();
        var age = $("#age").val();
        var birthplace = $("#birthplace").val();
        var gender = $("input[name='gender']:checked").val();
        var gpsaddress = $("#gpsaddress").val();
        var location = $("#location").val();
        var hometown = $("#hometown").val();
        var nationality = $("#nationality").val();
        var communicant = $("input[name='communicant']:checked").val();
        var baptismdate = $("#baptismdate").val();
        var confirmationdate = $("#confirmationdate").val();
        var emailaddress = $("#emailaddress").val();
        var placeofwork = $("#placeofwork").val();
        var society = $("#society").val();
        var occupation = $("#occupation").val();
        var random = '<?php echo $random; ?>';

        var error = '';

        // Validation for Full Name
        if ($("#fullname").val().trim() === "") {
            error += "Please enter full name\n";
            $("#fullname").focus();
        }

        // Validation for Date of Birth
        if ($("#dob").val().trim() === "") {
            error += "Please enter date of birth\n";
            $("#dob").focus();
        }

        // Validation for Place of Birth
        if ($("#birthplace").val().trim() === "") {
            error += "Please enter place of birth\n";
            $("#birthplace").focus();
        }

        // Validation for Hometown
        if ($("#hometown").val().trim() === "") {
            error += "Please enter hometown\n";
            $("#hometown").focus();
        }

        // Validation for Location
        if ($("#location").val().trim() === "") {
            error += "Please enter location\n";
            $("#location").focus();
        }

        // Validation for Gender
        if (typeof $("input[name='gender']:checked").val() === "undefined") {
            error += "Please select gender\n";
        }

        // Validation for Nationality
        if ($("#nationality").val().trim() === "") {
            error += "Please select nationality\n";
            $("#nationality").focus();
        }

        // Validation for Communicant
        if (typeof $("input[name='communicant']:checked").val() === "undefined") {
            error += "Please select communicant status\n";
        }

        // Validation for Email Address
        if (emailaddress !== "") {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailaddress)) {
                error += "Please enter a valid email address\n";
                $("#emailaddress").focus();
            }
        }


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajaxscripts/queries/save/member.php",
                beforeSend: function() {
                    $.blockUI({
                        message: '<h3 style="margin-top:6px"><img src="https://jquery.malsup.com/block/busy.gif" /> Just a moment...</h3>'
                    });
                },
                data: {
                    fullname,
                    maidenname,
                    telephone,
                    dob,
                    age,
                    birthplace,
                    gender,
                    gpsaddress,
                    location,
                    hometown,
                    nationality,
                    communicant,
                    baptismdate,
                    confirmationdate,
                    emailaddress,
                    placeofwork,
                    society,
                    occupation,
                    random
                },
                success: function(text) {
                    //alert(text);

                    if (text == 1) {
                        $.notify("Personal Information Saved", "success", {
                            position: "top center"
                        });
                        $.ajax({
                            url: "ajaxscripts/forms/familyinfo.php",
                            success: function(text) {
                                $('#familyinfodiv').html(text);
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                        });
                        var stepper = new Stepper(document.querySelector('.bs-stepper'))
                        stepper.to(2);
                    } else {
                        $.notify("Member already exists", "error", {
                            position: "top center"
                        });
                    }

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
                position: "top center"
            });
        }
        return false;

    }))
</script>