<?php
include('../../../config.php');
//$random = rand(1, 10) . date("Y-m-d H:i:s");
$branch = $_SESSION['branch'];
$memberid = $_POST['memberid'];

$getdetails = $mysqli->query("select * from `members` where id = '$memberid'");
$resdetails = $getdetails->fetch_assoc();
$random = $resdetails['random'];
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
            <label class="form-label">Passport Picture</label>
            <input type="file" class="form-control" id="memberpicture">
            <input type="hidden" id="selected" />
            <input type="hidden" id="selected_img_edit" value="edit_img" />
            <?php
            $img = $mysqli->query("SELECT * FROM member_images WHERE memberid = '{$resdetails['random']}'");
            if (mysqli_num_rows($img) == 1) {
                $fetch_img = $img->fetch_assoc();
                echo '<img src="../../' . $fetch_img['image_location'] . '" style="width: 100px; height: 100px;" />';
            } else {
                echo "";
            }
            ?>

        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-4">
            <label class="form-label" for="fullname">Full Name <span class="required"> * </span></label>
            <input type="text" id="fullname" class="form-control" placeholder="Full Name" value="<?php echo $resdetails['fullname']; ?>" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="maidenname">Maiden Name</label>
            <input type="text" id="maidenname" class="form-control" placeholder="Maiden Name" value="<?php echo $resdetails['maidenname']; ?>" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="telephone">Telephone</label>
            <input type="number" id="telephone" class="form-control" placeholder="Telephone" value="<?php echo $resdetails['telephone']; ?>" />
        </div>

    </div>

    <div class="row">
        <div class="mb-1 col-md-4">
            <label class="form-label" for="dob">Date of Birth <span class="required"> * </span></label>
            <input type="text" id="dob" class="form-control" placeholder="Date of Birth" value="<?php echo $resdetails['dob']; ?>" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="age">Age (auto generated)</label>
            <input type="text" id="age" class="form-control" placeholder="Age" readonly value="<?php echo $resdetails['age']; ?>" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="birthplace">Place of Birth <span class="required"> * </span></label>
            <input type="text" id="birthplace" class="form-control" placeholder="Place of Birth" value="<?php echo $resdetails['birthplace']; ?>" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-4">
            <label class="form-label">Gender <span class="required"> * </span></label> <br />
            <div>
                <span>
                    <input class="form-check-input" type="radio" name="gender" id="female" value="Male" <?php if (@$resdetails['gender'] == "Male") echo "checked" ?>>
                    <label class="form-check-label" for="male">Male</label>
                </span>
                <span style="margin-left: 20px;">
                    <input class="form-check-input ml-4" type="radio" name="gender" id="female" value="Female" <?php if (@$resdetails['gender'] == "Female") echo "checked" ?>>
                    <label class="form-check-label" for="female">Female</label>
                </span>
            </div>
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="gpsaddress">GPS Address</label>
            <input type="text" id="gpsaddress" class="form-control" placeholder="GPS Address" value="<?php echo $resdetails['gpsaddress']; ?>" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="location">Location <span class="required"> * </span></label>
            <input type="text" id="location" class="form-control" placeholder="Location" value="<?php echo $resdetails['location']; ?>" />
        </div>
    </div>

    <div class="row">

        <div class="mb-1 col-md-4">
            <label class="form-label" for="hometown">Hometown <span class="required"> * </span></label>
            <input type="text" id="hometown" class="form-control" placeholder="Hometown" value="<?php echo $resdetails['hometown']; ?>" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="location">Nationality <span class="required"> * </span></label>
            <select data-placeholder="Select Nationality" id="nationality" style="width: 100%" class="select2 form-select">
                <option></option>
                <option <?php if (@$resdetails['nationality'] == "Afghanistan") echo "Selected" ?>>Afghanistan</option>
                <option <?php if (@$resdetails['nationality'] == "Åland Islands") echo "Selected" ?>>Åland Islands</option>
                <option <?php if (@$resdetails['nationality'] == "Albania") echo "Selected" ?>>Albania</option>
                <option <?php if (@$resdetails['nationality'] == "Algeria") echo "Selected" ?>>Algeria</option>
                <option <?php if (@$resdetails['nationality'] == "American Samoa") echo "Selected" ?>>American Samoa</option>
                <option <?php if (@$resdetails['nationality'] == "Andorra") echo "Selected" ?>>Andorra</option>
                <option <?php if (@$resdetails['nationality'] == "Angola") echo "Selected" ?>>Angola</option>
                <option <?php if (@$resdetails['nationality'] == "Anguilla") echo "Selected" ?>>Anguilla</option>
                <option <?php if (@$resdetails['nationality'] == "Antarctica") echo "Selected" ?>>Antarctica</option>
                <option <?php if (@$resdetails['nationality'] == "Antigua and Barbuda") echo "Selected" ?>>Antigua and Barbuda</option>
                <option <?php if (@$resdetails['nationality'] == "Argentina") echo "Selected" ?>>Argentina</option>
                <option <?php if (@$resdetails['nationality'] == "Armenia") echo "Selected" ?>>Armenia</option>
                <option <?php if (@$resdetails['nationality'] == "Aruba") echo "Selected" ?>>Aruba</option>
                <option <?php if (@$resdetails['nationality'] == "Australia") echo "Selected" ?>>Australia</option>
                <option <?php if (@$resdetails['nationality'] == "Austria") echo "Selected" ?>>Austria</option>
                <option <?php if (@$resdetails['nationality'] == "Azerbaijan") echo "Selected" ?>>Azerbaijan</option>
                <option <?php if (@$resdetails['nationality'] == "Bahamas") echo "Selected" ?>>Bahamas</option>
                <option <?php if (@$resdetails['nationality'] == "Bahrain") echo "Selected" ?>>Bahrain</option>
                <option <?php if (@$resdetails['nationality'] == "Bangladesh") echo "Selected" ?>>Bangladesh</option>
                <option <?php if (@$resdetails['nationality'] == "Barbados") echo "Selected" ?>>Barbados</option>
                <option <?php if (@$resdetails['nationality'] == "Belarus") echo "Selected" ?>>Belarus</option>
                <option <?php if (@$resdetails['nationality'] == "Belgium") echo "Selected" ?>>Belgium</option>
                <option <?php if (@$resdetails['nationality'] == "Belize") echo "Selected" ?>>Belize</option>
                <option <?php if (@$resdetails['nationality'] == "Benin") echo "Selected" ?>>Benin</option>
                <option <?php if (@$resdetails['nationality'] == "Bermuda") echo "Selected" ?>>Bermuda</option>
                <option <?php if (@$resdetails['nationality'] == "Bhutan") echo "Selected" ?>>Bhutan</option>
                <option <?php if (@$resdetails['nationality'] == "Bolivia") echo "Selected" ?>>Bolivia</option>
                <option <?php if (@$resdetails['nationality'] == "Bosnia and Herzegovina") echo "Selected" ?>>Bosnia and Herzegovina</option>
                <option <?php if (@$resdetails['nationality'] == "Botswana") echo "Selected" ?>>Botswana</option>
                <option <?php if (@$resdetails['nationality'] == "Bouvet Island") echo "Selected" ?>>Bouvet Island</option>
                <option <?php if (@$resdetails['nationality'] == "Brazil") echo "Selected" ?>>Brazil</option>
                <option <?php if (@$resdetails['nationality'] == "British Indian Ocean Territory") echo "Selected" ?>>British Indian Ocean Territory</option>
                <option <?php if (@$resdetails['nationality'] == "Brunei Darussalam") echo "Selected" ?>>Brunei Darussalam</option>
                <option <?php if (@$resdetails['nationality'] == "Bulgaria") echo "Selected" ?>>Bulgaria</option>
                <option <?php if (@$resdetails['nationality'] == "Burkina Faso") echo "Selected" ?>>Burkina Faso</option>
                <option <?php if (@$resdetails['nationality'] == "Burundi") echo "Selected" ?>>Burundi</option>
                <option <?php if (@$resdetails['nationality'] == "Cambodia") echo "Selected" ?>>Cambodia</option>
                <option <?php if (@$resdetails['nationality'] == "Cameroon") echo "Selected" ?>>Cameroon</option>
                <option <?php if (@$resdetails['nationality'] == "Canada") echo "Selected" ?>>Canada</option>
                <option <?php if (@$resdetails['nationality'] == "Cape Verde") echo "Selected" ?>>Cape Verde</option>
                <option <?php if (@$resdetails['nationality'] == "Cayman Islands") echo "Selected" ?>>Cayman Islands</option>
                <option <?php if (@$resdetails['nationality'] == "Central African Republic") echo "Selected" ?>>Central African Republic</option>
                <option <?php if (@$resdetails['nationality'] == "Chad") echo "Selected" ?>>Chad</option>
                <option <?php if (@$resdetails['nationality'] == "Chile") echo "Selected" ?>>Chile</option>
                <option <?php if (@$resdetails['nationality'] == "China") echo "Selected" ?>>China</option>
                <option <?php if (@$resdetails['nationality'] == "Christmas Island") echo "Selected" ?>>Christmas Island</option>
                <option <?php if (@$resdetails['nationality'] == "Cocos (Keeling) Islands") echo "Selected" ?>>Cocos (Keeling) Islands</option>
                <option <?php if (@$resdetails['nationality'] == "Colombia") echo "Selected" ?>>Colombia</option>
                <option <?php if (@$resdetails['nationality'] == "Comoros") echo "Selected" ?>>Comoros</option>
                <option <?php if (@$resdetails['nationality'] == "Congo") echo "Selected" ?>>Congo</option>
                <option <?php if (@$resdetails['nationality'] == "Congo, The Democratic Republic of The") echo "Selected" ?>>Congo, The Democratic Republic of The</option>
                <option <?php if (@$resdetails['nationality'] == "Cook Islands") echo "Selected" ?>>Cook Islands</option>
                <option <?php if (@$resdetails['nationality'] == "Costa Rica") echo "Selected" ?>>Costa Rica</option>
                <option <?php if (@$resdetails['nationality'] == "Cote D'ivoire") echo "Selected" ?>>Cote D'ivoire</option>
                <option <?php if (@$resdetails['nationality'] == "Croatia") echo "Selected" ?>>Croatia</option>
                <option <?php if (@$resdetails['nationality'] == "Cuba") echo "Selected" ?>>Cuba</option>
                <option <?php if (@$resdetails['nationality'] == "Cyprus") echo "Selected" ?>>Cyprus</option>
                <option <?php if (@$resdetails['nationality'] == "Czech Republic") echo "Selected" ?>>Czech Republic</option>
                <option <?php if (@$resdetails['nationality'] == "Denmark") echo "Selected" ?>>Denmark</option>
                <option <?php if (@$resdetails['nationality'] == "Djibouti") echo "Selected" ?>>Djibouti</option>
                <option <?php if (@$resdetails['nationality'] == "Dominica") echo "Selected" ?>>Dominica</option>
                <option <?php if (@$resdetails['nationality'] == "Dominican Republic") echo "Selected" ?>>Dominican Republic</option>
                <option <?php if (@$resdetails['nationality'] == "Ecuador") echo "Selected" ?>>Ecuador</option>
                <option <?php if (@$resdetails['nationality'] == "Egypt") echo "Selected" ?>>Egypt</option>
                <option <?php if (@$resdetails['nationality'] == "El Salvador") echo "Selected" ?>>El Salvador</option>
                <option <?php if (@$resdetails['nationality'] == "Equatorial Guinea") echo "Selected" ?>>Equatorial Guinea</option>
                <option <?php if (@$resdetails['nationality'] == "Eritrea") echo "Selected" ?>>Eritrea</option>
                <option <?php if (@$resdetails['nationality'] == "Estonia") echo "Selected" ?>>Estonia</option>
                <option <?php if (@$resdetails['nationality'] == "Ethiopia") echo "Selected" ?>>Ethiopia</option>
                <option <?php if (@$resdetails['nationality'] == "Falkland Islands (Malvinas)") echo "Selected" ?>>Falkland Islands (Malvinas)</option>
                <option <?php if (@$resdetails['nationality'] == "Faroe Islands") echo "Selected" ?>>Faroe Islands</option>
                <option <?php if (@$resdetails['nationality'] == "Fiji") echo "Selected" ?>>Fiji</option>
                <option <?php if (@$resdetails['nationality'] == "Finland") echo "Selected" ?>>Finland</option>
                <option <?php if (@$resdetails['nationality'] == "France") echo "Selected" ?>>France</option>
                <option <?php if (@$resdetails['nationality'] == "French Guiana") echo "Selected" ?>>French Guiana</option>
                <option <?php if (@$resdetails['nationality'] == "French Polynesia") echo "Selected" ?>>French Polynesia</option>
                <option <?php if (@$resdetails['nationality'] == "French Southern Territories") echo "Selected" ?>>French Southern Territories</option>
                <option <?php if (@$resdetails['nationality'] == "Gabon") echo "Selected" ?>>Gabon</option>
                <option <?php if (@$resdetails['nationality'] == "Gambia") echo "Selected" ?>>Gambia</option>
                <option <?php if (@$resdetails['nationality'] == "Georgia") echo "Selected" ?>>Georgia</option>
                <option <?php if (@$resdetails['nationality'] == "Germany") echo "Selected" ?>>Germany</option>
                <option <?php if (@$resdetails['nationality'] == "Ghana") echo "Selected" ?>>Ghana</option>
                <option <?php if (@$resdetails['nationality'] == "Gibraltar") echo "Selected" ?>>Gibraltar</option>
                <option <?php if (@$resdetails['nationality'] == "Greece") echo "Selected" ?>>Greece</option>
                <option <?php if (@$resdetails['nationality'] == "Greenland") echo "Selected" ?>>Greenland</option>
                <option <?php if (@$resdetails['nationality'] == "Grenada") echo "Selected" ?>>Grenada</option>
                <option <?php if (@$resdetails['nationality'] == "Guadeloupe") echo "Selected" ?>>Guadeloupe</option>
                <option <?php if (@$resdetails['nationality'] == "Guam") echo "Selected" ?>>Guam</option>
                <option <?php if (@$resdetails['nationality'] == "Guatemala") echo "Selected" ?>>Guatemala</option>
                <option <?php if (@$resdetails['nationality'] == "Guernsey") echo "Selected" ?>>Guernsey</option>
                <option <?php if (@$resdetails['nationality'] == "Guinea") echo "Selected" ?>>Guinea</option>
                <option <?php if (@$resdetails['nationality'] == "Guinea-bissau") echo "Selected" ?>>Guinea-bissau</option>
                <option <?php if (@$resdetails['nationality'] == "Guyana") echo "Selected" ?>>Guyana</option>
                <option <?php if (@$resdetails['nationality'] == "Haiti") echo "Selected" ?>>Haiti</option>
                <option <?php if (@$resdetails['nationality'] == "Heard Island and Mcdonald Islands") echo "Selected" ?>>Heard Island and Mcdonald Islands</option>
                <option <?php if (@$resdetails['nationality'] == "Holy See (Vatican City State)") echo "Selected" ?>>Holy See (Vatican City State)</option>
                <option <?php if (@$resdetails['nationality'] == "Honduras") echo "Selected" ?>>Honduras</option>
                <option <?php if (@$resdetails['nationality'] == "Hong Kong") echo "Selected" ?>>Hong Kong</option>
                <option <?php if (@$resdetails['nationality'] == "Hungary") echo "Selected" ?>>Hungary</option>
                <option <?php if (@$resdetails['nationality'] == "Iceland") echo "Selected" ?>>Iceland</option>
                <option <?php if (@$resdetails['nationality'] == "India") echo "Selected" ?>>India</option>
                <option <?php if (@$resdetails['nationality'] == "Indonesia") echo "Selected" ?>>Indonesia</option>
                <option <?php if (@$resdetails['nationality'] == "Iran, Islamic Republic of") echo "Selected" ?>>Iran, Islamic Republic of</option>
                <option <?php if (@$resdetails['nationality'] == "Iraq") echo "Selected" ?>>Iraq</option>
                <option <?php if (@$resdetails['nationality'] == "Ireland") echo "Selected" ?>>Ireland</option>
                <option <?php if (@$resdetails['nationality'] == "Isle of Man") echo "Selected" ?>>Isle of Man</option>
                <option <?php if (@$resdetails['nationality'] == "Israel") echo "Selected" ?>>Israel</option>
                <option <?php if (@$resdetails['nationality'] == "Italy") echo "Selected" ?>>Italy</option>
                <option <?php if (@$resdetails['nationality'] == "Jamaica") echo "Selected" ?>>Jamaica</option>
                <option <?php if (@$resdetails['nationality'] == "Japan") echo "Selected" ?>>Japan</option>
                <option <?php if (@$resdetails['nationality'] == "Jersey") echo "Selected" ?>>Jersey</option>
                <option <?php if (@$resdetails['nationality'] == "Jordan") echo "Selected" ?>>Jordan</option>
                <option <?php if (@$resdetails['nationality'] == "Kazakhstan") echo "Selected" ?>>Kazakhstan</option>
                <option <?php if (@$resdetails['nationality'] == "Kenya") echo "Selected" ?>>Kenya</option>
                <option <?php if (@$resdetails['nationality'] == "Kiribati") echo "Selected" ?>>Kiribati</option>
                <option <?php if (@$resdetails['nationality'] == "Korea, Democratic People's Republic of") echo "Selected" ?>>Korea, Democratic People's Republic of</option>
                <option <?php if (@$resdetails['nationality'] == "Korea, Republic of") echo "Selected" ?>>Korea, Republic of</option>
                <option <?php if (@$resdetails['nationality'] == "Kuwait") echo "Selected" ?>>Kuwait</option>
                <option <?php if (@$resdetails['nationality'] == "Kyrgyzstan") echo "Selected" ?>>Kyrgyzstan</option>
                <option <?php if (@$resdetails['nationality'] == "Lao People's Democratic Republic") echo "Selected" ?>>Lao People's Democratic Republic</option>
                <option <?php if (@$resdetails['nationality'] == "Latvia") echo "Selected" ?>>Latvia</option>
                <option <?php if (@$resdetails['nationality'] == "Lebanon") echo "Selected" ?>>Lebanon</option>
                <option <?php if (@$resdetails['nationality'] == "Lesotho") echo "Selected" ?>>Lesotho</option>
                <option <?php if (@$resdetails['nationality'] == "Liberia") echo "Selected" ?>>Liberia</option>
                <option <?php if (@$resdetails['nationality'] == "Libyan Arab Jamahiriya") echo "Selected" ?>>Libyan Arab Jamahiriya</option>
                <option <?php if (@$resdetails['nationality'] == "Liechtenstein") echo "Selected" ?>>Liechtenstein</option>
                <option <?php if (@$resdetails['nationality'] == "Lithuania") echo "Selected" ?>>Lithuania</option>
                <option <?php if (@$resdetails['nationality'] == "Luxembourg") echo "Selected" ?>>Luxembourg</option>
                <option <?php if (@$resdetails['nationality'] == "Macao") echo "Selected" ?>>Macao</option>
                <option <?php if (@$resdetails['nationality'] == "Macedonia, The Former Yugoslav Republic of") echo "Selected" ?>>Macedonia, The Former Yugoslav Republic of</option>
                <option <?php if (@$resdetails['nationality'] == "Madagascar") echo "Selected" ?>>Madagascar</option>
                <option <?php if (@$resdetails['nationality'] == "Malawi") echo "Selected" ?>>Malawi</option>
                <option <?php if (@$resdetails['nationality'] == "Malaysia") echo "Selected" ?>>Malaysia</option>
                <option <?php if (@$resdetails['nationality'] == "Maldives") echo "Selected" ?>>Maldives</option>
                <option <?php if (@$resdetails['nationality'] == "Mali") echo "Selected" ?>>Mali</option>
                <option <?php if (@$resdetails['nationality'] == "Malta") echo "Selected" ?>>Malta</option>
                <option <?php if (@$resdetails['nationality'] == "Marshall Islands") echo "Selected" ?>>Marshall Islands</option>
                <option <?php if (@$resdetails['nationality'] == "Martinique") echo "Selected" ?>>Martinique</option>
                <option <?php if (@$resdetails['nationality'] == "Mauritania") echo "Selected" ?>>Mauritania</option>
                <option <?php if (@$resdetails['nationality'] == "Mauritius") echo "Selected" ?>>Mauritius</option>
                <option <?php if (@$resdetails['nationality'] == "Mayotte") echo "Selected" ?>>Mayotte</option>
                <option <?php if (@$resdetails['nationality'] == "Mexico") echo "Selected" ?>>Mexico</option>
                <option <?php if (@$resdetails['nationality'] == "Micronesia, Federated States of") echo "Selected" ?>>Micronesia, Federated States of</option>
                <option <?php if (@$resdetails['nationality'] == "Moldova, Republic of") echo "Selected" ?>>Moldova, Republic of</option>
                <option <?php if (@$resdetails['nationality'] == "Monaco") echo "Selected" ?>>Monaco</option>
                <option <?php if (@$resdetails['nationality'] == "Mongolia") echo "Selected" ?>>Mongolia</option>
                <option <?php if (@$resdetails['nationality'] == "Montenegro") echo "Selected" ?>>Montenegro</option>
                <option <?php if (@$resdetails['nationality'] == "Montserrat") echo "Selected" ?>>Montserrat</option>
                <option <?php if (@$resdetails['nationality'] == "Morocco") echo "Selected" ?>>Morocco</option>
                <option <?php if (@$resdetails['nationality'] == "Mozambique") echo "Selected" ?>>Mozambique</option>
                <option <?php if (@$resdetails['nationality'] == "Myanmar") echo "Selected" ?>>Myanmar</option>
                <option <?php if (@$resdetails['nationality'] == "Namibia") echo "Selected" ?>>Namibia</option>
                <option <?php if (@$resdetails['nationality'] == "Nauru") echo "Selected" ?>>Nauru</option>
                <option <?php if (@$resdetails['nationality'] == "Nepal") echo "Selected" ?>>Nepal</option>
                <option <?php if (@$resdetails['nationality'] == "Netherlands") echo "Selected" ?>>Netherlands</option>
                <option <?php if (@$resdetails['nationality'] == "Netherlands Antilles") echo "Selected" ?>>Netherlands Antilles</option>
                <option <?php if (@$resdetails['nationality'] == "New Caledonia") echo "Selected" ?>>New Caledonia</option>
                <option <?php if (@$resdetails['nationality'] == "New Zealand") echo "Selected" ?>>New Zealand</option>
                <option <?php if (@$resdetails['nationality'] == "Nicaragua") echo "Selected" ?>>Nicaragua</option>
                <option <?php if (@$resdetails['nationality'] == "Niger") echo "Selected" ?>>Niger</option>
                <option <?php if (@$resdetails['nationality'] == "Nigeria") echo "Selected" ?>>Nigeria</option>
                <option <?php if (@$resdetails['nationality'] == "Niue") echo "Selected" ?>>Niue</option>
                <option <?php if (@$resdetails['nationality'] == "Norfolk Island") echo "Selected" ?>>Norfolk Island</option>
                <option <?php if (@$resdetails['nationality'] == "Northern Mariana Islands") echo "Selected" ?>>Northern Mariana Islands</option>
                <option <?php if (@$resdetails['nationality'] == "Norway") echo "Selected" ?>>Norway</option>
                <option <?php if (@$resdetails['nationality'] == "Oman") echo "Selected" ?>>Oman</option>
                <option <?php if (@$resdetails['nationality'] == "Pakistan") echo "Selected" ?>>Pakistan</option>
                <option <?php if (@$resdetails['nationality'] == "Palau") echo "Selected" ?>>Palau</option>
                <option <?php if (@$resdetails['nationality'] == "Palestinian Territory, Occupied") echo "Selected" ?>>Palestinian Territory, Occupied</option>
                <option <?php if (@$resdetails['nationality'] == "Panama") echo "Selected" ?>>Panama</option>
                <option <?php if (@$resdetails['nationality'] == "Papua New Guinea") echo "Selected" ?>>Papua New Guinea</option>
                <option <?php if (@$resdetails['nationality'] == "Paraguay") echo "Selected" ?>>Paraguay</option>
                <option <?php if (@$resdetails['nationality'] == "Peru") echo "Selected" ?>>Peru</option>
                <option <?php if (@$resdetails['nationality'] == "Philippines") echo "Selected" ?>>Philippines</option>
                <option <?php if (@$resdetails['nationality'] == "Pitcairn") echo "Selected" ?>>Pitcairn</option>
                <option <?php if (@$resdetails['nationality'] == "Poland") echo "Selected" ?>>Poland</option>
                <option <?php if (@$resdetails['nationality'] == "Portugal") echo "Selected" ?>>Portugal</option>
                <option <?php if (@$resdetails['nationality'] == "Puerto Rico") echo "Selected" ?>>Puerto Rico</option>
                <option <?php if (@$resdetails['nationality'] == "Qatar") echo "Selected" ?>>Qatar</option>
                <option <?php if (@$resdetails['nationality'] == "Reunion") echo "Selected" ?>>Reunion</option>
                <option <?php if (@$resdetails['nationality'] == "Romania") echo "Selected" ?>>Romania</option>
                <option <?php if (@$resdetails['nationality'] == "Russian Federation") echo "Selected" ?>>Russian Federation</option>
                <option <?php if (@$resdetails['nationality'] == "Rwanda") echo "Selected" ?>>Rwanda</option>
                <option <?php if (@$resdetails['nationality'] == "Saint Helena") echo "Selected" ?>>Saint Helena</option>
                <option <?php if (@$resdetails['nationality'] == "Saint Kitts and Nevis") echo "Selected" ?>>Saint Kitts and Nevis</option>
                <option <?php if (@$resdetails['nationality'] == "Saint Lucia") echo "Selected" ?>>Saint Lucia</option>
                <option <?php if (@$resdetails['nationality'] == "Saint Pierre and Miquelon") echo "Selected" ?>>Saint Pierre and Miquelon</option>
                <option <?php if (@$resdetails['nationality'] == "Saint Vincent and The Grenadines") echo "Selected" ?>>Saint Vincent and The Grenadines</option>
                <option <?php if (@$resdetails['nationality'] == "Samoa") echo "Selected" ?>>Samoa</option>
                <option <?php if (@$resdetails['nationality'] == "San Marino") echo "Selected" ?>>San Marino</option>
                <option <?php if (@$resdetails['nationality'] == "Sao Tome and Principe") echo "Selected" ?>>Sao Tome and Principe</option>
                <option <?php if (@$resdetails['nationality'] == "Saudi Arabia") echo "Selected" ?>>Saudi Arabia</option>
                <option <?php if (@$resdetails['nationality'] == "Senegal") echo "Selected" ?>>Senegal</option>
                <option <?php if (@$resdetails['nationality'] == "Serbia") echo "Selected" ?>>Serbia</option>
                <option <?php if (@$resdetails['nationality'] == "Seychelles") echo "Selected" ?>>Seychelles</option>
                <option <?php if (@$resdetails['nationality'] == "Sierra Leone") echo "Selected" ?>>Sierra Leone</option>
                <option <?php if (@$resdetails['nationality'] == "Singapore") echo "Selected" ?>>Singapore</option>
                <option <?php if (@$resdetails['nationality'] == "Slovakia") echo "Selected" ?>>Slovakia</option>
                <option <?php if (@$resdetails['nationality'] == "Slovenia") echo "Selected" ?>>Slovenia</option>
                <option <?php if (@$resdetails['nationality'] == "Solomon Islands") echo "Selected" ?>>Solomon Islands</option>
                <option <?php if (@$resdetails['nationality'] == "Somalia") echo "Selected" ?>>Somalia</option>
                <option <?php if (@$resdetails['nationality'] == "South Africa") echo "Selected" ?>>South Africa</option>
                <option <?php if (@$resdetails['nationality'] == "South Georgia and The South Sandwich Islands") echo "Selected" ?>>South Georgia and The South Sandwich Islands</option>
                <option <?php if (@$resdetails['nationality'] == "Spain") echo "Selected" ?>>Spain</option>
                <option <?php if (@$resdetails['nationality'] == "Sri Lanka") echo "Selected" ?>>Sri Lanka</option>
                <option <?php if (@$resdetails['nationality'] == "Sudan") echo "Selected" ?>>Sudan</option>
                <option <?php if (@$resdetails['nationality'] == "Suriname") echo "Selected" ?>>Suriname</option>
                <option <?php if (@$resdetails['nationality'] == "Svalbard and Jan Mayen") echo "Selected" ?>>Svalbard and Jan Mayen</option>
                <option <?php if (@$resdetails['nationality'] == "Swaziland") echo "Selected" ?>>Swaziland</option>
                <option <?php if (@$resdetails['nationality'] == "Sweden") echo "Selected" ?>>Sweden</option>
                <option <?php if (@$resdetails['nationality'] == "Switzerland") echo "Selected" ?>>Switzerland</option>
                <option <?php if (@$resdetails['nationality'] == "Syrian Arab Republic") echo "Selected" ?>>Syrian Arab Republic</option>
                <option <?php if (@$resdetails['nationality'] == "Taiwan") echo "Selected" ?>>Taiwan</option>
                <option <?php if (@$resdetails['nationality'] == "Tajikistan") echo "Selected" ?>>Tajikistan</option>
                <option <?php if (@$resdetails['nationality'] == "Tanzania, United Republic of") echo "Selected" ?>>Tanzania, United Republic of</option>
                <option <?php if (@$resdetails['nationality'] == "Thailand") echo "Selected" ?>>Thailand</option>
                <option <?php if (@$resdetails['nationality'] == "Timor-leste") echo "Selected" ?>>Timor-leste</option>
                <option <?php if (@$resdetails['nationality'] == "Togo") echo "Selected" ?>>Togo</option>
                <option <?php if (@$resdetails['nationality'] == "Tokelau") echo "Selected" ?>>Tokelau</option>
                <option <?php if (@$resdetails['nationality'] == "Tonga") echo "Selected" ?>>Tonga</option>
                <option <?php if (@$resdetails['nationality'] == "Trinidad and Tobago") echo "Selected" ?>>Trinidad and Tobago</option>
                <option <?php if (@$resdetails['nationality'] == "Tunisia") echo "Selected" ?>>Tunisia</option>
                <option <?php if (@$resdetails['nationality'] == "Turkey") echo "Selected" ?>>Turkey</option>
                <option <?php if (@$resdetails['nationality'] == "Turkmenistan") echo "Selected" ?>>Turkmenistan</option>
                <option <?php if (@$resdetails['nationality'] == "Turks and Caicos Islands") echo "Selected" ?>>Turks and Caicos Islands</option>
                <option <?php if (@$resdetails['nationality'] == "Tuvalu") echo "Selected" ?>>Tuvalu</option>
                <option <?php if (@$resdetails['nationality'] == "Uganda") echo "Selected" ?>>Uganda</option>
                <option <?php if (@$resdetails['nationality'] == "Ukraine") echo "Selected" ?>>Ukraine</option>
                <option <?php if (@$resdetails['nationality'] == "United Arab Emirates") echo "Selected" ?>>United Arab Emirates</option>
                <option <?php if (@$resdetails['nationality'] == "United Kingdom") echo "Selected" ?>>United Kingdom</option>
                <option <?php if (@$resdetails['nationality'] == "United States") echo "Selected" ?>>United States</option>
                <option <?php if (@$resdetails['nationality'] == "United States Minor Outlying Islands") echo "Selected" ?>>United States Minor Outlying Islands</option>
                <option <?php if (@$resdetails['nationality'] == "Uruguay") echo "Selected" ?>>Uruguay</option>
                <option <?php if (@$resdetails['nationality'] == "Uzbekistan") echo "Selected" ?>>Uzbekistan</option>
                <option <?php if (@$resdetails['nationality'] == "Vanuatu") echo "Selected" ?>>Vanuatu</option>
                <option <?php if (@$resdetails['nationality'] == "Venezuela") echo "Selected" ?>>Venezuela</option>
                <option <?php if (@$resdetails['nationality'] == "Viet Nam") echo "Selected" ?>>Viet Nam</option>
                <option <?php if (@$resdetails['nationality'] == "Virgin Islands, British") echo "Selected" ?>>Virgin Islands, British</option>
                <option <?php if (@$resdetails['nationality'] == "Virgin Islands, U.S.") echo "Selected" ?>>Virgin Islands, U.S.</option>
                <option <?php if (@$resdetails['nationality'] == "Wallis and Futuna") echo "Selected" ?>>Wallis and Futuna</option>
                <option <?php if (@$resdetails['nationality'] == "Western Sahara") echo "Selected" ?>>Western Sahara</option>
                <option <?php if (@$resdetails['nationality'] == "Yemen") echo "Selected" ?>>Yemen</option>
                <option <?php if (@$resdetails['nationality'] == "Zambia") echo "Selected" ?>>Zambia</option>
                <option <?php if (@$resdetails['nationality'] == "Zimbabwe") echo "Selected" ?>>Zimbabwe</option>
            </select>
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label">Communicant <span class="required"> * </span></label> <br />
            <div>
                <span>
                    <input class="form-check-input" type="radio" name="communicant" id="communicantyes" value="Yes" <?php if (@$resdetails['communicant'] == "Yes") echo "checked" ?>>
                    <label class="form-check-label" for="communicantyes">Yes</label>
                </span>
                <span style="margin-left: 20px;">
                    <input class="form-check-input ml-4" type="radio" name="communicant" id="communicantno" value="No" <?php if (@$resdetails['communicant'] == "No") echo "checked" ?>>
                    <label class="form-check-label" for="communicantno">No</label>
                </span>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="mb-1 col-md-4">
            <label class="form-label" for="baptismdate">Baptism Date</label>
            <input type="text" id="baptismdate" class="form-control" placeholder="Baptism Date" value="<?php if ($resdetails['baptismdate'] == "0000-00-00") {
                                                                                                            echo "";
                                                                                                        } else echo $resdetails['baptismdate']; ?>" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="confirmationdate">Confirmation Date/Place</label>
            <input type="text" id="confirmationdate" class="form-control" placeholder="Confirmation Date/Place" value="<?php echo $resdetails['confirmationdate']; ?>" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="emailaddress">Email Address</label>
            <input type="text" id="emailaddress" class="form-control" placeholder="Email Address" value="<?php echo $resdetails['emailaddress']; ?>" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-4">
            <label class="form-label" for="occupation">Occupation</label>
            <input type="text" id="occupation" class="form-control" placeholder="Occupation" value="<?php echo $resdetails['occupation']; ?>" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="placeofwork">Place of Work</label>
            <input type="text" id="placeofwork" class="form-control" placeholder="Place of Work" value="<?php echo $resdetails['placeofwork']; ?>" />
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="society">Society</label>
            <select class="form-select" id="society" name="society"> <!-- Added name attribute for form submission -->
                <option></option>
                <?php
                // Assuming $selectedValue contains the previously selected value by the user, fetched from the database or any other source
                $selectedValue = $resdetails['society']; // Initialize selected value variable

                $getsociety = $mysqli->query("SELECT * FROM ministry WHERE branch = '$branch'");
                while ($ressociety = $getsociety->fetch_assoc()) {
                    $id = $ressociety['id'];
                    $ministry_name = $ressociety['ministry_name'];
                    $selected = ($id == $selectedValue) ? "selected" : ""; // Check if this option is selected

                    echo "<option value='$id' $selected>$ministry_name</option>";
                }
                ?>
            </select>

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
    $('#memberpicture').uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload Picture',
        'fileType': 'image/*',
        'multi': false,
        'width': 180,
        "fileSizeLimit": "20MB",
        'formData': {
            'randno': '<?php echo $random ?>'
        },
        'dnd': false,
        'uploadScript': 'ajaxscripts/queries/upload/memberpic.php',
        'onUploadComplete': function(file, data) {
            console.log(data);
        },
        'onSelect': function(file) {
            // Update selected so we know they have selected a file
            $("#selected").val('yes');
        },
        'onCancel': function(file) {
            // Update selected so we know they have no file selected
            $("#selected").val('');
        }
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
        var memberid = '<?php echo $memberid; ?>';

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
                url: "ajaxscripts/queries/edit/member.php",
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
                    random,
                    memberid
                },
                success: function(text) {
                    //alert(text);

                    if (text == 1) {
                        $('#memberpicture').uploadifive('upload');
                        $.notify("Personal Information Updated", "success", {
                            position: "top center"
                        });
                        $.ajax({
                            type: "POST",
                            url: "ajaxscripts/forms/editfamilyinfo.php",
                            data: {
                                memberid: '<?php echo $memberid; ?>'
                            },
                            success: function(text) {
                                $('#familyinfodiv').html(text);
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function() {
                                $.unblockUI();
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