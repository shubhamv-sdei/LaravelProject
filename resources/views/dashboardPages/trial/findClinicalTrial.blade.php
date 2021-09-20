@extends('dashboardLayouts.app')

@section('title')
@endsection

@section('container')
<div class="content-wrapper">
        <div class="p-3 p-md-4">
            <div class="wrapper">
                <div class="wrapper-title">
                    <span>Find a study</span>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="p-xl-5 container">
                            @if(Session::has('msg'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  {{ Session::get('msg') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-xl-12">
                <!-- <h5 class="text-center fw-500 mb-3"><span class="text-uppercase">Find a study</span> <span class="text-secondary">(all fields optional)</span></h5> -->
                <div class="bg-white p-3 px-lg-5 py-lg-4">
                    <form class="form row" action="{{route('Dashboard.findStudy')}}" method="post">
                        @csrf

                        <div class="col-md-12 form-group">
                            <label><span class="red_required">*</span>Search Type</label>
                            <div class="custom-radio">
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="form-check-input" name="search_type" checked="" value="1">
                                        <i class="form-icon"></i>National Search <small><i>( U.S. National Library of Medicine)</i></small>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="form-check-input" name="search_type" value="2">
                                        <i class="form-icon"></i>Internal Search <small><i>( ClinicalMatch database)</i></small>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 form-group form-control-border">
                            <!-- <input type="text" id="condition" class="form-control" required> -->
                            <input type="text" class="form-control" value="{{Session::get('con')}}" name="con" required id="condition" autocomplete="off">
                            <label class="form-control-placeholder" for="condition"><span class="red_required">*</span>Condition or Disease</label>
                            <div class="result-list">
                                <div class="result-list-container" style="display:none;">
                                    <ul>
                                        <li>Option 1</li>
                                        <li>Option 2</li>
                                        <li>Option 3</li>
                                        <li>Option 4</li>
                                        <li>Option 5</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 form-group form-control-border">
                            <select id="country" class="form-control" name="cntry" tabindex="5" style="width:100%;" required>
                                <option disabled  value="0">Select Country</option>
                                <option value="United States">United States</option>
                                <option value="Afghanistan"  >Afghanistan</option>
                                <option value="Albania"  >Albania</option>
                                <option value="Algeria"  >Algeria</option>
                                <option value="American Samoa"  >American Samoa</option>
                                <option value="Andorra"  >Andorra</option>
                                <option value="Angola"  >Angola</option>
                                <option value="Antigua and Barbuda"  >Antigua and Barbuda</option>
                                <option value="Argentina"  >Argentina</option>
                                <option value="Armenia"  >Armenia</option>
                                <option value="Aruba"  >Aruba</option>
                                <option value="Australia"  >Australia</option>
                                <option value="Austria"  >Austria</option>
                                <option value="Azerbaijan"  >Azerbaijan</option>
                                <option value="Bahamas"  >Bahamas</option>
                                <option value="Bahrain"  >Bahrain</option>
                                <option value="Bangladesh"  >Bangladesh</option>
                                <option value="Barbados"  >Barbados</option>
                                <option value="Belarus"  >Belarus</option>
                                <option value="Belgium"  >Belgium</option>
                                <option value="Belize"  >Belize</option>
                                <option value="Benin"  >Benin</option>
                                <option value="Bermuda"  >Bermuda</option>
                                <option value="Bhutan"  >Bhutan</option>
                                <option value="Bolivia"  >Bolivia</option>
                                <option value="Bosnia and Herzegovina"  >Bosnia and Herzegovina</option>
                                <option value="Botswana"  >Botswana</option>
                                <option value="Brazil"  >Brazil</option>
                                <option value="Brunei Darussalam"  >Brunei Darussalam</option>
                                <option value="Bulgaria"  >Bulgaria</option>
                                <option value="Burkina Faso"  >Burkina Faso</option>
                                <option value="Burundi"  >Burundi</option>
                                <option value="Cambodia"  >Cambodia</option>
                                <option value="Cameroon"  >Cameroon</option>
                                <option value="Canada"  >Canada</option>
                                <option value="Cayman Islands"  >Cayman Islands</option>
                                <option value="Central African Republic"  >Central African Republic</option>
                                <option value="Chad"  >Chad</option>
                                <option value="Chile"  >Chile</option>
                                <option value="China"  >China</option>
                                <option value="Colombia"  >Colombia</option>
                                <option value="Comoros"  >Comoros</option>
                                <option value="Congo"  >Congo</option>
                                <option value="Congo, The Democratic Republic of the"  >Congo, The Democratic Republic of the</option>
                                <option value="Costa Rica"  >Costa Rica</option>
                                <option value="Croatia"  >Croatia</option>
                                <option value="Cuba"  >Cuba</option>
                                <option value="Cyprus"  >Cyprus</option>
                                <option value="Czech Republic"  >Czech Republic</option>
                                <option value="C&#244;te D&apos;Ivoire"  >C&#244;te D&apos;Ivoire</option>
                                <option value="Denmark"  >Denmark</option>
                                <option value="Djibouti"  >Djibouti</option>
                                <option value="Dominica"  >Dominica</option>
                                <option value="Dominican Republic"  >Dominican Republic</option>
                                <option value="Ecuador"  >Ecuador</option>
                                <option value="Egypt"  >Egypt</option>
                                <option value="El Salvador"  >El Salvador</option>
                                <option value="Equatorial Guinea"  >Equatorial Guinea</option>
                                <option value="Estonia"  >Estonia</option>
                                <option value="Ethiopia"  >Ethiopia</option>
                                <option value="Faroe Islands"  >Faroe Islands</option>
                                <option value="Fiji"  >Fiji</option>
                                <option value="Finland"  >Finland</option>
                                <option value="Former Serbia and Montenegro"  >Former Serbia and Montenegro</option>
                                <option value="Former Yugoslavia"  >Former Yugoslavia</option>
                                <option value="France"  >France</option>
                                <option value="French Guiana"  >French Guiana</option>
                                <option value="French Polynesia"  >French Polynesia</option>
                                <option value="Gabon"  >Gabon</option>
                                <option value="Gambia"  >Gambia</option>
                                <option value="Georgia"  >Georgia</option>
                                <option value="Germany"  >Germany</option>
                                <option value="Ghana"  >Ghana</option>
                                <option value="Gibraltar"  >Gibraltar</option>
                                <option value="Greece"  >Greece</option>
                                <option value="Greenland"  >Greenland</option>
                                <option value="Grenada"  >Grenada</option>
                                <option value="Guadeloupe"  >Guadeloupe</option>
                                <option value="Guam"  >Guam</option>
                                <option value="Guatemala"  >Guatemala</option>
                                <option value="Guinea"  >Guinea</option>
                                <option value="Guinea-Bissau"  >Guinea-Bissau</option>
                                <option value="Guyana"  >Guyana</option>
                                <option value="Haiti"  >Haiti</option>
                                <option value="Holy See (Vatican City State)"  >Holy See (Vatican City State)</option>
                                <option value="Honduras"  >Honduras</option>
                                <option value="Hong Kong"  >Hong Kong</option>
                                <option value="Hungary"  >Hungary</option>
                                <option value="Iceland"  >Iceland</option>
                                <option value="India"  >India</option>
                                <option value="Indonesia"  >Indonesia</option>
                                <option value="Iran"  >Iran</option>
                                <option value="Iraq"  >Iraq</option>
                                <option value="Ireland"  >Ireland</option>
                                <option value="Israel"  >Israel</option>
                                <option value="Italy"  >Italy</option>
                                <option value="Jamaica"  >Jamaica</option>
                                <option value="Japan"  >Japan</option>
                                <option value="Jersey"  >Jersey</option>
                                <option value="Jordan"  >Jordan</option>
                                <option value="Kazakhstan"  >Kazakhstan</option>
                                <option value="Kenya"  >Kenya</option>
                                <option value="Kiribati"  >Kiribati</option>
                                <option value="Korea, Democratic People&apos;s Republic of"  >Korea, Democratic People&apos;s Republic of</option>
                                <option value="Korea, Republic of"  >Korea, Republic of</option>
                                <option value="Kuwait"  >Kuwait</option>
                                <option value="Kyrgyzstan"  >Kyrgyzstan</option>
                                <option value="Lao People&apos;s Democratic Republic"  >Lao People&apos;s Democratic Republic</option>
                                <option value="Latvia"  >Latvia</option>
                                <option value="Lebanon"  >Lebanon</option>
                                <option value="Lesotho"  >Lesotho</option>
                                <option value="Liberia"  >Liberia</option>
                                <option value="Libyan Arab Jamahiriya"  >Libyan Arab Jamahiriya</option>
                                <option value="Liechtenstein"  >Liechtenstein</option>
                                <option value="Lithuania"  >Lithuania</option>
                                <option value="Luxembourg"  >Luxembourg</option>
                                <option value="Macedonia, The Former Yugoslav Republic of"  >Macedonia, The Former Yugoslav Republic of</option>
                                <option value="Madagascar"  >Madagascar</option>
                                <option value="Malawi"  >Malawi</option>
                                <option value="Malaysia"  >Malaysia</option>
                                <option value="Maldives"  >Maldives</option>
                                <option value="Mali"  >Mali</option>
                                <option value="Malta"  >Malta</option>
                                <option value="Martinique"  >Martinique</option>
                                <option value="Mauritania"  >Mauritania</option>
                                <option value="Mauritius"  >Mauritius</option>
                                <option value="Mayotte"  >Mayotte</option>
                                <option value="Mexico"  >Mexico</option>
                                <option value="Moldova, Republic of<"  >Moldova, Republic of</option>
                                <option value="Monaco"  >Monaco</option>
                                <option value="Mongolia"  >Mongolia</option>
                                <option value="Montenegro"  >Montenegro</option>
                                <option value="Montserrat"  >Montserrat</option>
                                <option value="Morocco"  >Morocco</option>
                                <option value="Mozambique"  >Mozambique</option>
                                <option value="Myanmar"  >Myanmar</option>
                                <option value="Namibia"  >Namibia</option>
                                <option value="Nepal"  >Nepal</option>
                                <option value="Netherlands"  >Netherlands</option>
                                <option value="Netherlands Antilles"  >Netherlands Antilles</option>
                                <option value="New Caledonia"  >New Caledonia</option>
                                <option value="New Zealand"  >New Zealand</option>
                                <option value="Nicaragua"  >Nicaragua</option>
                                <option value="Niger"  >Niger</option>
                                <option value="Nigeria"  >Nigeria</option>
                                <option value="Northern Mariana Islands"  >Northern Mariana Islands</option>
                                <option value="Norway"  >Norway</option>
                                <option value="Oman"  >Oman</option>
                                <option value="Pakistan"  >Pakistan</option>
                                <option value="Panama"  >Panama</option>
                                <option value="Papua New Guinea"  >Papua New Guinea</option>
                                <option value="Paraguay"  >Paraguay</option>
                                <option value="Peru"  >Peru</option>
                                <option value="Philippines"  >Philippines</option>
                                <option value="Poland"  >Poland</option>
                                <option value="Portugal"  >Portugal</option>
                                <option value="Puerto Rico"  >Puerto Rico</option>
                                <option value="Qatar"  >Qatar</option>
                                <option value="Romania"  >Romania</option>
                                <option value="Russian Federation"  >Russian Federation</option>
                                <option value="Rwanda"  >Rwanda</option>
                                <option value="R&#233;union"  >R&#233;union</option>
                                <option value="Saint Kitts and Nevis"  >Saint Kitts and Nevis</option>
                                <option value="Saint Lucia"  >Saint Lucia</option>
                                <option value="Saint Vincent and the Grenadines"  >Saint Vincent and the Grenadines</option>
                                <option value="Samoa"  >Samoa</option>
                                <option value="Saudi Arabia"  >Saudi Arabia</option>
                                <option value="Senegal"  >Senegal</option>
                                <option value="Serbia"  >Serbia</option>
                                <option value="Seychelles"  >Seychelles</option>
                                <option value="Sierra Leone"  >Sierra Leone</option>
                                <option value="Singapore"  >Singapore</option>
                                <option value="Slovakia"  >Slovakia</option>
                                <option value="Slovenia"  >Slovenia</option>
                                <option value="Solomon Islands"  >Solomon Islands</option>
                                <option value="Somalia"  >Somalia</option>
                                <option value="South Africa"  >South Africa</option>
                                <option value="Spain"  >Spain</option>
                                <option value="Sri Lanka"  >Sri Lanka</option>
                                <option value="Sudan"  >Sudan</option>
                                <option value="Suriname"  >Suriname</option>
                                <option value="Swaziland"  >Swaziland</option>
                                <option value="Sweden"  >Sweden</option>
                                <option value="Switzerland"  >Switzerland</option>
                                <option value="Syrian Arab Republic"  >Syrian Arab Republic</option>
                                <option value="Taiwan"  >Taiwan</option>
                                <option value="Tajikistan"  >Tajikistan</option>
                                <option value="Tanzania"  >Tanzania</option>
                                <option value="Thailand"  >Thailand</option>
                                <option value="Togo"  >Togo</option>
                                <option value="Trinidad and Tobago"  >Trinidad and Tobago</option>
                                <option value="Tunisia"  >Tunisia</option>
                                <option value="Turkey"  >Turkey</option>
                                <option value="Uganda"  >Uganda</option>
                                <option value="Ukraine"  >Ukraine</option>
                                <option value="United Arab Emirates"  >United Arab Emirates</option>
                                <option value="United Kingdom"  >United Kingdom</option>
                                <option value="Uruguay"  >Uruguay</option>
                                <option value="Uzbekistan"  >Uzbekistan</option>
                                <option value="Vanuatu"  >Vanuatu</option>
                                <option value="Venezuela"  >Venezuela</option>
                                <option value="Vietnam"  >Vietnam</option>
                                <option value="Virgin Islands (U.S.)"  >Virgin Islands (U.S.)</option>
                                <option value="Yemen"  >Yemen</option>
                                <option value="Zambia"  >Zambia</option>
                                <option value="Zimbabwe"  >Zimbabwe</option>
                            </select>
                            <label class="form-control-placeholder" for="country">Country</label>
                        </div>
                        <div class="col-md-6 form-group form-control-border" id="detail">
                            <select id="state" class="form-control" name="state" tabindex="6" style="width:100%;">
                                <option value=""  selected="selected"  >Select State
                                <option value="Alabama">Alabama</option>
                                <option value="Alaska">Alaska</option>
                                <option value="Arizona">Arizona</option>
                                <option value="Arizona">Arizona</option>
                                <option value="California">California</option>
                                <option value="Colorado">Colorado</option>
                                <option value="Connecticut">Connecticut</option>
                                <option value="Delaware">Delaware</option>
                                <option value="District of Columbia">District of Columbia</option>
                                <option value="Florida">Florida</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Hawaii">Hawaii</option>
                                <option value="Idaho">Idaho</option>
                                <option value="Illinois">Illinois</option>
                                <option value="Indiana">Indiana</option>
                                <option value="Iowa">Iowa</option>
                                <option value="Kansas">Kansas</option>
                                <option value="Kentucky">Kentucky</option>
                                <option value="Louisiana">Louisiana</option>
                                <option value="Maine">Maine</option>
                                <option value="Maryland">Maryland</option>
                                <option value="Massachusetts">Massachusetts</option>
                                <option value="Michigan">Michigan</option>
                                <option value="Minnesota">Minnesota</option>
                                <option value="Mississippi">Mississippi</option>
                                <option value="Missouri">Missouri</option>
                                <option value="Montana">Montana</option>
                                <option value="Nebraska">Nebraska</option>
                                <option value="Nevada">Nevada</option>
                                <option value="New Hampshire">New Hampshire</option>
                                <option value="New Jersey">New Jersey</option>
                                <option value="New Mexico">New Mexico</option>
                                <option value="New York">New York</option>
                                <option value="North Carolina">North Carolina</option>
                                <option value="North Dakota">North Dakota</option>
                                <option value="Ohio">Ohio</option>
                                <option value="Oklahoma">Oklahoma</option>
                                <option value="Oregon">Oregon</option>
                                <option value="Pennsylvania">Pennsylvania</option>
                                <option value="Rhode Island">Rhode Island</option>
                                <option value="South Carolina">South Carolina</option>
                                <option value="South Dakota">South Dakota</option>
                                <option value="Tennessee">Tennessee</option>
                                <option value="Texas">Texas</option>
                                <option value="Utah">Utah</option>
                                <option value="Vermont">Vermont</option>
                                <option value="Virginia">Virginia</option>
                                <option value="Washington">Washington</option>
                                <option value="West Virginia">West Virginia</option>
                                <option value="Wisconsin">Wisconsin</option>
                                <option value="Wyoming">Wyoming</option>
                            </select>
                            <label class="form-control-placeholder" for="state">State</label>
                        </div>
                        <div class="col-md-6 form-group form-control-border" id="detail2">
                            <input type="text" id="city" class="form-control">
                            <label class="form-control-placeholder" for="city">City</label>
                        </div>
                        <div class="col-md-6 form-group form-control-border">
                            <input type="text" id="phone" class="form-control">
                            <label class="form-control-placeholder" for="phone">Phone Number</label>
                        </div>
                        <div class="col-md-6 form-group form-control-border">
                            <input type="text" id="age" class="form-control">
                            <label class="form-control-placeholder" for="age">Age</label>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>How many mile radius from you?</label>
                            <div class="custom-radio">
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="form-check-input" name="mile_radius">
                                        <i class="form-icon"></i>20 miles
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="form-check-input" name="mile_radius" checked="">
                                        <i class="form-icon"></i>100 miles
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="form-check-input" name="mile_radius">
                                        <i class="form-icon"></i>Any
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Sex</label>
                            <div class="custom-radio">
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="form-check-input" name="sex" checked="">
                                        <i class="form-icon"></i>Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="form-check-input" name="sex">
                                        <i class="form-icon"></i>Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-orange btn-wide">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</div>
</main>

@endsection

@section('script')
<script type="text/javascript">
    $('body').click(function(){
        $('.result-list-container').fadeOut();
    });

    $("#detail").hide();
    $("#detail2").hide();
      $("#country").change(function(){
    
        if($("#country").val() != '')
        {
          if($("#country").val() == 'United States'){
            $("#detail").show();
            $("#detail2").show();
            $("#state_label").show();
            $("#state_val").show();
          }
          else {
            $("#detail").hide();
            $("#detail2").show();
            $("#state_label").hide();
            $("#state_val").hide();
          }
        }
        else {
          $("#detail").hide();
        }
      })
</script>

<script>
    $(document).ready(function(){
    
     $('#condition').keyup(function(e){ 
        e.preventDefault();
            var query = $(this).val();
            if(query != '')
            {
             var _token = $('input[name="_token"]').val();
             $.ajax({
              url:"{{ route('autocomplete.fetch') }}",
              method:"POST",
              data:{query:query, _token:_token},
              success:function(data){
                if(data !=''){
                    $('.result-list-container').fadeIn();  
                        $('.result-list-container').html(data);
                }else{
                      $('.result-list-container').fadeIn();  
                        $('.result-list-container').html('No data found');
                }
               
              }
             });
            }
        });
    
        $(document).on('click', 'li', function(){  
            $('#condition').val($(this).text());  
            $('.result-list-container').fadeOut();  
        });  
    
    });
    </script>

<div class="map" id="map">
</div>
</div>
<script>
    var placeSearch, autocomplete;
    var componentForm = {
      country: 'long_name',  
      administrative_area_level_1: 'short_name',
      locality: 'long_name'
    };
    
    function initAutocomplete() {
      // Create the autocomplete object, restricting the search predictions to
      // geographical location types.
      autocomplete = new google.maps.places.Autocomplete(
          document.getElementById('autocomplete'), {types: ['geocode']});
    
      // Avoid paying for data that you don't need by restricting the set of
      // place fields that are returned to just the address components.
      autocomplete.setFields(['address_component']);
    
      // When the user selects an address from the drop-down, populate the
      // address fields in the form.
      autocomplete.addListener('place_changed', fillInAddress);
    }
    
    function fillInAddress() {
      // Get the place details from the autocomplete object.
      var place = autocomplete.getPlace();
    
      for (var component in componentForm) {
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
      }
    
      // Get each component of the address from the place details,
      // and then fill-in the corresponding field on the form.
      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
          var val = place.address_components[i][componentForm[addressType]];
          document.getElementById(addressType).value = val;
        }
      }
    }
    
    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var geolocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          var circle = new google.maps.Circle(
              {center: geolocation, radius: position.coords.accuracy});
          autocomplete.setBounds(circle.getBounds());
        });
      }
    }
        
</script>

<script src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDAAWN9v--d2Un1ufiz3CZPtgkwcq-rl_w&libraries=places&callback=initAutocomplete" async defer > </script>
@endsection