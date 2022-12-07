<section class="page-header-section" >
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 col-lg-6">
                <div class="page-header-content text-white">
                    <h1 class="text-white mb-2">
                        <i class="fa fa-sign-in"></i> Client Register
                    </h1>
                </div>
            </div>
        </div>
    </div>
</section>







<section id="main-body">
    

    <script>
        var statesTab = 10;
        var stateNotRequired = true;
    </script>

<script type="text/javascript" src="<?=theme_base()?>/assets/StatesDropdown.js"></script>
<script type="text/javascript" src="https://whmcs.themetags.com/assets/js/PasswordStrength.js"></script>
<script>
    window.langPasswordStrength = "Password Strength";
    window.langPasswordWeak = "Weak";
    window.langPasswordModerate = "Moderate";
    window.langPasswordStrong = "Strong";
    jQuery(document).ready(function()
    {
        jQuery("#inputNewPassword1").keyup(registerFormPasswordStrengthFeedback);
    });
</script>
<style>
    .hidden{
        display:none;
    }
</style>
<script type="text/javascript">
    var csrfToken = '8570d3c14c4e5a945c8bb52e87cd9561172efe57',
        markdownGuide = 'Markdown Guide',
        locale = 'en',
        saved = 'saved',
        saving = 'autosaving',
        saved = 'saved',
        saving = 'autosaving',
        whmcsBaseUrl = "",
        requiredText = 'Required',
        recaptchaSiteKey = "";
</script>
<script src="<?=theme_base()?>assets/scripts.min.js?v=a1db48"></script>

<div class="container">
    <div class="row">
        <div class="auth-content-wrap col-sm-12">
            <div id="registration" class="logincontainer signupcontainer">
                <div class="auth-body">
                    <form method="post" class="using-password-strength" action="/register" role="form" name="orderfrm" id="frmCheckout" autocomplete="off">

                        <input type="hidden" name="register" value="true">
                
                        <div id="containerNewUserSignup">
                            <div class="header-lined auth-header text-center">
                                <h1>Create Your Account</h1>
                            </div>
                                                        
                                            
                            <div class="sub-heading">
                                <h3>Personal Information</h3>
                            </div>
                            <div class="custom-card-block mb-40">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group prepend-icon">
                                            <input type="text" name="firstname" id="inputFirstName" class="field form-control" placeholder="First Name" value="" required="" autofocus="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group prepend-icon">
                                            <input type="text" name="lastname" id="inputLastName" class="field form-control" placeholder="Last Name" value="" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group prepend-icon">
                                            <input type="email" name="email" id="inputEmail" class="field form-control" placeholder="Email Address" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group prepend-icon">
                                            <input type="tel" name="mobile" id="inputPhone" class="form-control" placeholder="Phone Number" value="" autocomplete="off" data-initial-value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                
                            <div class="sub-heading">
                                <h3>Billing Address</h3>
                            </div>
                            <div class="custom-card-block mb-40">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group prepend-icon">
                                            <input type="text" name="companyname" id="inputCompanyName" class="field form-control" placeholder="Company Name (Optional)" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group prepend-icon">
                                            <input type="text" name="address1" id="inputAddress1" class="field form-control" placeholder="Street Address" value="" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group prepend-icon">
                                            <input type="text" name="address2" id="inputAddress2" class="field form-control" placeholder="Street Address 2" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group prepend-icon">
                                            <input type="text" name="city" id="inputCity" class="field form-control" placeholder="City" value="" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group prepend-icon">
                                            <input type="text" id="stateinput" class="field form-control" placeholder="State" value="" style="display: none;">
                                        <select name="state" class="field form-control custom-select" id="stateselect"></select></div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group prepend-icon">
                                            <input type="text" name="postcode" id="inputPostcode" class="field form-control" placeholder="Postcode" value="" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group prepend-icon">
                                            <select name="country" id="inputCountry" class="field form-control">
                                                                                                    <option value="AF">
                                                        Afghanistan
                                                    </option>
                                                                                                    <option value="AX">
                                                        Aland Islands
                                                    </option>
                                                                                                    <option value="AL">
                                                        Albania
                                                    </option>
                                                                                                    <option value="DZ">
                                                        Algeria
                                                    </option>
                                                                                                    <option value="AS">
                                                        American Samoa
                                                    </option>
                                                                                                    <option value="AD">
                                                        Andorra
                                                    </option>
                                                                                                    <option value="AO">
                                                        Angola
                                                    </option>
                                                                                                    <option value="AI">
                                                        Anguilla
                                                    </option>
                                                                                                    <option value="AQ">
                                                        Antarctica
                                                    </option>
                                                                                                    <option value="AG">
                                                        Antigua And Barbuda
                                                    </option>
                                                                                                    <option value="AR">
                                                        Argentina
                                                    </option>
                                                                                                    <option value="AM">
                                                        Armenia
                                                    </option>
                                                                                                    <option value="AW">
                                                        Aruba
                                                    </option>
                                                                                                    <option value="AU">
                                                        Australia
                                                    </option>
                                                                                                    <option value="AT">
                                                        Austria
                                                    </option>
                                                                                                    <option value="AZ">
                                                        Azerbaijan
                                                    </option>
                                                                                                    <option value="BS">
                                                        Bahamas
                                                    </option>
                                                                                                    <option value="BH">
                                                        Bahrain
                                                    </option>
                                                                                                    <option value="BD">
                                                        Bangladesh
                                                    </option>
                                                                                                    <option value="BB">
                                                        Barbados
                                                    </option>
                                                                                                    <option value="BY">
                                                        Belarus
                                                    </option>
                                                                                                    <option value="BE">
                                                        Belgium
                                                    </option>
                                                                                                    <option value="BZ">
                                                        Belize
                                                    </option>
                                                                                                    <option value="BJ">
                                                        Benin
                                                    </option>
                                                                                                    <option value="BM">
                                                        Bermuda
                                                    </option>
                                                                                                    <option value="BT">
                                                        Bhutan
                                                    </option>
                                                                                                    <option value="BO">
                                                        Bolivia
                                                    </option>
                                                                                                    <option value="BA">
                                                        Bosnia And Herzegovina
                                                    </option>
                                                                                                    <option value="BW">
                                                        Botswana
                                                    </option>
                                                                                                    <option value="BR">
                                                        Brazil
                                                    </option>
                                                                                                    <option value="IO">
                                                        British Indian Ocean Territory
                                                    </option>
                                                                                                    <option value="BN">
                                                        Brunei Darussalam
                                                    </option>
                                                                                                    <option value="BG">
                                                        Bulgaria
                                                    </option>
                                                                                                    <option value="BF">
                                                        Burkina Faso
                                                    </option>
                                                                                                    <option value="BI">
                                                        Burundi
                                                    </option>
                                                                                                    <option value="KH">
                                                        Cambodia
                                                    </option>
                                                                                                    <option value="CM">
                                                        Cameroon
                                                    </option>
                                                                                                    <option value="CA">
                                                        Canada
                                                    </option>
                                                                                                    <option value="IC">
                                                        Canary Islands
                                                    </option>
                                                                                                    <option value="CV">
                                                        Cape Verde
                                                    </option>
                                                                                                    <option value="KY">
                                                        Cayman Islands
                                                    </option>
                                                                                                    <option value="CF">
                                                        Central African Republic
                                                    </option>
                                                                                                    <option value="TD">
                                                        Chad
                                                    </option>
                                                                                                    <option value="CL">
                                                        Chile
                                                    </option>
                                                                                                    <option value="CN">
                                                        China
                                                    </option>
                                                                                                    <option value="CX">
                                                        Christmas Island
                                                    </option>
                                                                                                    <option value="CC">
                                                        Cocos (Keeling) Islands
                                                    </option>
                                                                                                    <option value="CO">
                                                        Colombia
                                                    </option>
                                                                                                    <option value="KM">
                                                        Comoros
                                                    </option>
                                                                                                    <option value="CG">
                                                        Congo
                                                    </option>
                                                                                                    <option value="CD">
                                                        Congo, Democratic Republic
                                                    </option>
                                                                                                    <option value="CK">
                                                        Cook Islands
                                                    </option>
                                                                                                    <option value="CR">
                                                        Costa Rica
                                                    </option>
                                                                                                    <option value="CI">
                                                        Cote D'Ivoire
                                                    </option>
                                                                                                    <option value="HR">
                                                        Croatia
                                                    </option>
                                                                                                    <option value="CU">
                                                        Cuba
                                                    </option>
                                                                                                    <option value="CW">
                                                        Curacao
                                                    </option>
                                                                                                    <option value="CY">
                                                        Cyprus
                                                    </option>
                                                                                                    <option value="CZ">
                                                        Czech Republic
                                                    </option>
                                                                                                    <option value="DK">
                                                        Denmark
                                                    </option>
                                                                                                    <option value="DJ">
                                                        Djibouti
                                                    </option>
                                                                                                    <option value="DM">
                                                        Dominica
                                                    </option>
                                                                                                    <option value="DO">
                                                        Dominican Republic
                                                    </option>
                                                                                                    <option value="EC">
                                                        Ecuador
                                                    </option>
                                                                                                    <option value="EG">
                                                        Egypt
                                                    </option>
                                                                                                    <option value="SV">
                                                        El Salvador
                                                    </option>
                                                                                                    <option value="GQ">
                                                        Equatorial Guinea
                                                    </option>
                                                                                                    <option value="ER">
                                                        Eritrea
                                                    </option>
                                                                                                    <option value="EE">
                                                        Estonia
                                                    </option>
                                                                                                    <option value="ET">
                                                        Ethiopia
                                                    </option>
                                                                                                    <option value="FK">
                                                        Falkland Islands (Malvinas)
                                                    </option>
                                                                                                    <option value="FO">
                                                        Faroe Islands
                                                    </option>
                                                                                                    <option value="FJ">
                                                        Fiji
                                                    </option>
                                                                                                    <option value="FI">
                                                        Finland
                                                    </option>
                                                                                                    <option value="FR">
                                                        France
                                                    </option>
                                                                                                    <option value="GF">
                                                        French Guiana
                                                    </option>
                                                                                                    <option value="PF">
                                                        French Polynesia
                                                    </option>
                                                                                                    <option value="TF">
                                                        French Southern Territories
                                                    </option>
                                                                                                    <option value="GA">
                                                        Gabon
                                                    </option>
                                                                                                    <option value="GM">
                                                        Gambia
                                                    </option>
                                                                                                    <option value="GE">
                                                        Georgia
                                                    </option>
                                                                                                    <option value="DE">
                                                        Germany
                                                    </option>
                                                                                                    <option value="GH">
                                                        Ghana
                                                    </option>
                                                                                                    <option value="GI">
                                                        Gibraltar
                                                    </option>
                                                                                                    <option value="GR">
                                                        Greece
                                                    </option>
                                                                                                    <option value="GL">
                                                        Greenland
                                                    </option>
                                                                                                    <option value="GD">
                                                        Grenada
                                                    </option>
                                                                                                    <option value="GP">
                                                        Guadeloupe
                                                    </option>
                                                                                                    <option value="GU">
                                                        Guam
                                                    </option>
                                                                                                    <option value="GT">
                                                        Guatemala
                                                    </option>
                                                                                                    <option value="GG">
                                                        Guernsey
                                                    </option>
                                                                                                    <option value="GN">
                                                        Guinea
                                                    </option>
                                                                                                    <option value="GW">
                                                        Guinea-Bissau
                                                    </option>
                                                                                                    <option value="GY">
                                                        Guyana
                                                    </option>
                                                                                                    <option value="HT">
                                                        Haiti
                                                    </option>
                                                                                                    <option value="HM">
                                                        Heard Island &amp; Mcdonald Islands
                                                    </option>
                                                                                                    <option value="VA">
                                                        Holy See (Vatican City State)
                                                    </option>
                                                                                                    <option value="HN">
                                                        Honduras
                                                    </option>
                                                                                                    <option value="HK">
                                                        Hong Kong
                                                    </option>
                                                                                                    <option value="HU">
                                                        Hungary
                                                    </option>
                                                                                                    <option value="IS">
                                                        Iceland
                                                    </option>
                                                                                                    <option value="IN"  selected="selected">
                                                        India
                                                    </option>
                                                                                                    <option value="ID">
                                                        Indonesia
                                                    </option>
                                                                                                    <option value="IR">
                                                        Iran, Islamic Republic Of
                                                    </option>
                                                                                                    <option value="IQ">
                                                        Iraq
                                                    </option>
                                                                                                    <option value="IE">
                                                        Ireland
                                                    </option>
                                                                                                    <option value="IM">
                                                        Isle Of Man
                                                    </option>
                                                                                                    <option value="IL">
                                                        Israel
                                                    </option>
                                                                                                    <option value="IT">
                                                        Italy
                                                    </option>
                                                                                                    <option value="JM">
                                                        Jamaica
                                                    </option>
                                                                                                    <option value="JP">
                                                        Japan
                                                    </option>
                                                                                                    <option value="JE">
                                                        Jersey
                                                    </option>
                                                                                                    <option value="JO">
                                                        Jordan
                                                    </option>
                                                                                                    <option value="KZ">
                                                        Kazakhstan
                                                    </option>
                                                                                                    <option value="KE">
                                                        Kenya
                                                    </option>
                                                                                                    <option value="KI">
                                                        Kiribati
                                                    </option>
                                                                                                    <option value="KR">
                                                        Korea
                                                    </option>
                                                                                                    <option value="XK">
                                                        Kosovo
                                                    </option>
                                                                                                    <option value="KW">
                                                        Kuwait
                                                    </option>
                                                                                                    <option value="KG">
                                                        Kyrgyzstan
                                                    </option>
                                                                                                    <option value="LA">
                                                        Lao People's Democratic Republic
                                                    </option>
                                                                                                    <option value="LV">
                                                        Latvia
                                                    </option>
                                                                                                    <option value="LB">
                                                        Lebanon
                                                    </option>
                                                                                                    <option value="LS">
                                                        Lesotho
                                                    </option>
                                                                                                    <option value="LR">
                                                        Liberia
                                                    </option>
                                                                                                    <option value="LY">
                                                        Libyan Arab Jamahiriya
                                                    </option>
                                                                                                    <option value="LI">
                                                        Liechtenstein
                                                    </option>
                                                                                                    <option value="LT">
                                                        Lithuania
                                                    </option>
                                                                                                    <option value="LU">
                                                        Luxembourg
                                                    </option>
                                                                                                    <option value="MO">
                                                        Macao
                                                    </option>
                                                                                                    <option value="MK">
                                                        Macedonia
                                                    </option>
                                                                                                    <option value="MG">
                                                        Madagascar
                                                    </option>
                                                                                                    <option value="MW">
                                                        Malawi
                                                    </option>
                                                                                                    <option value="MY">
                                                        Malaysia
                                                    </option>
                                                                                                    <option value="MV">
                                                        Maldives
                                                    </option>
                                                                                                    <option value="ML">
                                                        Mali
                                                    </option>
                                                                                                    <option value="MT">
                                                        Malta
                                                    </option>
                                                                                                    <option value="MH">
                                                        Marshall Islands
                                                    </option>
                                                                                                    <option value="MQ">
                                                        Martinique
                                                    </option>
                                                                                                    <option value="MR">
                                                        Mauritania
                                                    </option>
                                                                                                    <option value="MU">
                                                        Mauritius
                                                    </option>
                                                                                                    <option value="YT">
                                                        Mayotte
                                                    </option>
                                                                                                    <option value="MX">
                                                        Mexico
                                                    </option>
                                                                                                    <option value="FM">
                                                        Micronesia, Federated States Of
                                                    </option>
                                                                                                    <option value="MD">
                                                        Moldova
                                                    </option>
                                                                                                    <option value="MC">
                                                        Monaco
                                                    </option>
                                                                                                    <option value="MN">
                                                        Mongolia
                                                    </option>
                                                                                                    <option value="ME">
                                                        Montenegro
                                                    </option>
                                                                                                    <option value="MS">
                                                        Montserrat
                                                    </option>
                                                                                                    <option value="MA">
                                                        Morocco
                                                    </option>
                                                                                                    <option value="MZ">
                                                        Mozambique
                                                    </option>
                                                                                                    <option value="MM">
                                                        Myanmar
                                                    </option>
                                                                                                    <option value="NA">
                                                        Namibia
                                                    </option>
                                                                                                    <option value="NR">
                                                        Nauru
                                                    </option>
                                                                                                    <option value="NP">
                                                        Nepal
                                                    </option>
                                                                                                    <option value="NL">
                                                        Netherlands
                                                    </option>
                                                                                                    <option value="AN">
                                                        Netherlands Antilles
                                                    </option>
                                                                                                    <option value="NC">
                                                        New Caledonia
                                                    </option>
                                                                                                    <option value="NZ">
                                                        New Zealand
                                                    </option>
                                                                                                    <option value="NI">
                                                        Nicaragua
                                                    </option>
                                                                                                    <option value="NE">
                                                        Niger
                                                    </option>
                                                                                                    <option value="NG">
                                                        Nigeria
                                                    </option>
                                                                                                    <option value="NU">
                                                        Niue
                                                    </option>
                                                                                                    <option value="NF">
                                                        Norfolk Island
                                                    </option>
                                                                                                    <option value="MP">
                                                        Northern Mariana Islands
                                                    </option>
                                                                                                    <option value="NO">
                                                        Norway
                                                    </option>
                                                                                                    <option value="OM">
                                                        Oman
                                                    </option>
                                                                                                    <option value="PK">
                                                        Pakistan
                                                    </option>
                                                                                                    <option value="PW">
                                                        Palau
                                                    </option>
                                                                                                    <option value="PS">
                                                        Palestine, State of
                                                    </option>
                                                                                                    <option value="PA">
                                                        Panama
                                                    </option>
                                                                                                    <option value="PG">
                                                        Papua New Guinea
                                                    </option>
                                                                                                    <option value="PY">
                                                        Paraguay
                                                    </option>
                                                                                                    <option value="PE">
                                                        Peru
                                                    </option>
                                                                                                    <option value="PH">
                                                        Philippines
                                                    </option>
                                                                                                    <option value="PN">
                                                        Pitcairn
                                                    </option>
                                                                                                    <option value="PL">
                                                        Poland
                                                    </option>
                                                                                                    <option value="PT">
                                                        Portugal
                                                    </option>
                                                                                                    <option value="PR">
                                                        Puerto Rico
                                                    </option>
                                                                                                    <option value="QA">
                                                        Qatar
                                                    </option>
                                                                                                    <option value="RE">
                                                        Reunion
                                                    </option>
                                                                                                    <option value="RO">
                                                        Romania
                                                    </option>
                                                                                                    <option value="RU">
                                                        Russian Federation
                                                    </option>
                                                                                                    <option value="RW">
                                                        Rwanda
                                                    </option>
                                                                                                    <option value="BL">
                                                        Saint Barthelemy
                                                    </option>
                                                                                                    <option value="SH">
                                                        Saint Helena
                                                    </option>
                                                                                                    <option value="KN">
                                                        Saint Kitts And Nevis
                                                    </option>
                                                                                                    <option value="LC">
                                                        Saint Lucia
                                                    </option>
                                                                                                    <option value="MF">
                                                        Saint Martin
                                                    </option>
                                                                                                    <option value="PM">
                                                        Saint Pierre And Miquelon
                                                    </option>
                                                                                                    <option value="VC">
                                                        Saint Vincent And Grenadines
                                                    </option>
                                                                                                    <option value="WS">
                                                        Samoa
                                                    </option>
                                                                                                    <option value="SM">
                                                        San Marino
                                                    </option>
                                                                                                    <option value="ST">
                                                        Sao Tome And Principe
                                                    </option>
                                                                                                    <option value="SA">
                                                        Saudi Arabia
                                                    </option>
                                                                                                    <option value="SN">
                                                        Senegal
                                                    </option>
                                                                                                    <option value="RS">
                                                        Serbia
                                                    </option>
                                                                                                    <option value="SC">
                                                        Seychelles
                                                    </option>
                                                                                                    <option value="SL">
                                                        Sierra Leone
                                                    </option>
                                                                                                    <option value="SG">
                                                        Singapore
                                                    </option>
                                                                                                    <option value="SK">
                                                        Slovakia
                                                    </option>
                                                                                                    <option value="SI">
                                                        Slovenia
                                                    </option>
                                                                                                    <option value="SB">
                                                        Solomon Islands
                                                    </option>
                                                                                                    <option value="SO">
                                                        Somalia
                                                    </option>
                                                                                                    <option value="ZA">
                                                        South Africa
                                                    </option>
                                                                                                    <option value="GS">
                                                        South Georgia And Sandwich Isl.
                                                    </option>
                                                                                                    <option value="ES">
                                                        Spain
                                                    </option>
                                                                                                    <option value="LK">
                                                        Sri Lanka
                                                    </option>
                                                                                                    <option value="SD">
                                                        Sudan
                                                    </option>
                                                                                                    <option value="SS">
                                                        South Sudan
                                                    </option>
                                                                                                    <option value="SR">
                                                        Suriname
                                                    </option>
                                                                                                    <option value="SJ">
                                                        Svalbard And Jan Mayen
                                                    </option>
                                                                                                    <option value="SZ">
                                                        Swaziland
                                                    </option>
                                                                                                    <option value="SE">
                                                        Sweden
                                                    </option>
                                                                                                    <option value="CH">
                                                        Switzerland
                                                    </option>
                                                                                                    <option value="SY">
                                                        Syrian Arab Republic
                                                    </option>
                                                                                                    <option value="TW">
                                                        Taiwan
                                                    </option>
                                                                                                    <option value="TJ">
                                                        Tajikistan
                                                    </option>
                                                                                                    <option value="TZ">
                                                        Tanzania
                                                    </option>
                                                                                                    <option value="TH">
                                                        Thailand
                                                    </option>
                                                                                                    <option value="TL">
                                                        Timor-Leste
                                                    </option>
                                                                                                    <option value="TG">
                                                        Togo
                                                    </option>
                                                                                                    <option value="TK">
                                                        Tokelau
                                                    </option>
                                                                                                    <option value="TO">
                                                        Tonga
                                                    </option>
                                                                                                    <option value="TT">
                                                        Trinidad And Tobago
                                                    </option>
                                                                                                    <option value="TN">
                                                        Tunisia
                                                    </option>
                                                                                                    <option value="TR">
                                                        Turkey
                                                    </option>
                                                                                                    <option value="TM">
                                                        Turkmenistan
                                                    </option>
                                                                                                    <option value="TC">
                                                        Turks And Caicos Islands
                                                    </option>
                                                                                                    <option value="TV">
                                                        Tuvalu
                                                    </option>
                                                                                                    <option value="UG">
                                                        Uganda
                                                    </option>
                                                                                                    <option value="UA">
                                                        Ukraine
                                                    </option>
                                                                                                    <option value="AE">
                                                        United Arab Emirates
                                                    </option>
                                                                                                    <option value="GB">
                                                        United Kingdom
                                                    </option>
                                                                                                    <option value="US">
                                                        United States
                                                    </option>
                                                                                                    <option value="UM">
                                                        United States Outlying Islands
                                                    </option>
                                                                                                    <option value="UY">
                                                        Uruguay
                                                    </option>
                                                                                                    <option value="UZ">
                                                        Uzbekistan
                                                    </option>
                                                                                                    <option value="VU">
                                                        Vanuatu
                                                    </option>
                                                                                                    <option value="VE">
                                                        Venezuela
                                                    </option>
                                                                                                    <option value="VN">
                                                        Viet Nam
                                                    </option>
                                                                                                    <option value="VG">
                                                        Virgin Islands, British
                                                    </option>
                                                                                                    <option value="VI">
                                                        Virgin Islands, U.S.
                                                    </option>
                                                                                                    <option value="WF">
                                                        Wallis And Futuna
                                                    </option>
                                                                                                    <option value="EH">
                                                        Western Sahara
                                                    </option>
                                                                                                    <option value="YE">
                                                        Yemen
                                                    </option>
                                                                                                    <option value="ZM">
                                                        Zambia
                                                    </option>
                                                                                                    <option value="ZW">
                                                        Zimbabwe
                                                    </option>
                                                                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div id="containerNewUserSecurity">
                
                            <div class="sub-heading">
                                <h3>Account Security</h3>
                            </div>
                            <div class="custom-card-block mb-40">
                                <div id="containerPassword" class="row">
                                    <div id="passwdFeedback" style="display: none;" class="alert alert-info text-center col-sm-12"></div>
                                    <div class="col-sm-6">
                                        <div class="form-group prepend-icon">
                                            <input type="password" name="password" id="inputNewPassword1" data-error-threshold="50" data-warning-threshold="75" class="field form-control" placeholder="Password" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group prepend-icon">
                                            <input type="password" name="password2" id="inputNewPassword2" class="field form-control" placeholder="Confirm Password" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="password-strength-meter password-wrap form-group">
                                            <button type="button" class="btn outline-btn btn-sm generate-password" data-targetfields="inputNewPassword1,inputNewPassword2">
                                                Generate Password
                                            </button>
                                            <div class="progress" style="margin-right:10px">
                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="passwordStrengthMeterBar"></div>
                                                <p class="text-center small text-muted" id="passwordStrengthTextLabel">Password Strength: Enter a Password</p>
                                            </div>
                                            <button type="button" class="btn outline-btn btn-sm show-hide-btn" data-targetfields="inputNewPassword1,inputNewPassword2">
                                                <i class="fa fa-eye"></i> Show
                                            </button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                
                              
                                        
                                        
                        <br>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="sub-heading">
                                    <h3>Terms of Service</h3>
                                </div>
                                <div class="custom-card-block terms-condition mb-40">
                                   <label class="checkbox">
                                        <input type="checkbox" name="accepttos" class="accepttos">
                                        I have read and agree to the <a href="#" target="_blank">Terms of Service</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                                                
                        <p class="text-center">
                            <button class="btn primary-solid-btn submit-btn" type="submit" disabled>Create Your Account</button>
                        </p>
                                             
                    </form>
                </div>
                <div class="text-center auth-footer">Already registered with us? <a href="/clientarea">Login</a> <span class="text-lowercase">Or</span> <a href="/password/reset">Forgot Password?</a></div>
            </div>
                        
        </div>
    </div>
</div>


</section>

<script>
$('.accepttos').click(function(){
    $('.submit-btn').prop("disabled", !$(this).is(':checked') );
});
    $('.show-hide-btn').click(function(){
        var fields = $(this).data('targetfields').split(',');
        var id1 = fields[0],
            id2 = fields[1];
        if($('#'+id1).attr('type') == 'text'){
            $('#'+id1).attr('type','password');
            $('#'+id2).attr('type','password');
            $(this).html('<i class="fa fa-eye"></i> Show');
        }
        else{
            
            $('#'+id1).attr('type','text');
            $('#'+id2).attr('type','text');
            $(this).html('<i class="fa fa-eye-slash"></i> Hide');
        }
    });
    $(document).ready(function (){
           // toastr.success("Hello World!");
       
           $('#frmCheckout').submit(function(event){
               event.preventDefault();
               var form = this;
               //console.log($(this).serialize());
                var url = $(this).attr('action'),
                   method = $(this).attr('method'),
                   data = $(this).serialize();
                 var btn_html =  $('.submit-btn').html();
                 $('.submit-btn').html('<i class="fa fa-spin fa-spinner"></i> Loading...').prop('disabled',true);
                $.ajax({
                    type : url,
                    method : method,
                    data : data,
                    dataType : 'json',
                    success : function(res){
                        console.log(res);
                        if(!res.status){
                            $.each(res.errors, function(index, value){
                                toastr.error(value );//+ '<br>');
                            });
                        }
                        else{
                            toastr.success('Registered Successfully...');//+ '<br>');
                             $('#frmCheckout')[0].reset();
                        }
                        
                        $('.submit-btn').html(btn_html).prop('disabled',false);
                    },
                    error:function(r,b,v){
                        console.log(r.responseText);
                    }
                });
           });
    });
</script>


<form action="#" id="frmGeneratePassword" class="form-horizontal">
    <div class="modal fade" id="modalGeneratePassword" style="z-index: 9999;">
        <div class="modal-dialog" style="margin: 86px auto;">
            <div class="modal-content panel-primary" style="width:600px">
                <div class="modal-header panel-heading">
                    <h4 class="modal-title">
                        Generate Password
                    </h4>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger hidden" id="generatePwLengthError">
                        Please enter a number between 8 and 64 for the password length
                    </div>
                    <div class="form-group row">
                        <label for="generatePwLength" class="col-sm-4 control-label">Password Length</label>
                        <div class="col-sm-8">
                            <input type="number" min="8" max="64" value="12" step="1" class="form-control input-inline input-inline-100" id="inputGeneratePasswordLength">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="generatePwOutput" class="col-sm-4 control-label">Generated Password</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputGeneratePasswordOutput">
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-sm-5"></div>
                        <div class="col-sm-7 row" style="padding:0">
                            <button type="submit" class="btn btn-check-all btn-sm col-sm-8">
                                <i class="fas fa-plus fa-fw"></i>
                                Generate new password
                            </button>
                            <button type="button" class="btn btn-default btn-sm copy-to-clipboard col-sm-3" data-clipboard-target="#inputGeneratePasswordOutput">
                                <img src="<?=theme_base()?>/assets/clippy.svg" alt="Copy to clipboard" width="15">
                                Copy
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn outline-btn" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn primary-solid-btn" id="btnGeneratePasswordInsert" data-clipboard-target="#inputGeneratePasswordOutput">
                        Copy to clipboard & Insert
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
