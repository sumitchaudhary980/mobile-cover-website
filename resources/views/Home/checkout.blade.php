<style>
    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="number"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    input[type="radio"],
    input[type="checkbox"] {
        margin-right: 10px;
    }
</style>
@extends('home.masterview')
@section('location')
    <div class="container" style="margin-top: 100px">
        <div class="col-12">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="col-sm-12  text-center">
            <img src="image/download.png" alt="">
            <h3 class="text-dark text-capitalize">checkout</h3>
            <p class="text-primary">Enter Address Details: </p>
        </div>

        <div class="row justify-content-center">

            <form action="{{ url('payment') }}" method="GET">
                <div class="form-control shadow-lg border-success">

                    <div class="form-check">
                        <input class=" form-check-input shadow border-dark" type="radio" name="address" id="add"
                            required>
                        <label class="form-check-label" for="add" value="$user->address">
                            {{ $user->address }}
                        </label> <br>
                        <button type="submit"
                            class="btn btn-primary  shadow border-success text-white mt-3 col-sm-6 col-md-4 col-lg-2"
                            id="payment">Deliver Here</button>
                    </div>
                    <input type="hidden" name="access_token" value="{{ csrf_token() }}">
                </div>

            </form>
            @foreach ($address as $data)
                <form action="{{ url('payment') }}" method="GET" class="mt-5">
                    <div class="form-control shadow-lg border-success">

                        <div class="form-check">
                            <input class=" form-check-input shadow border-dark" type="radio" name="address"
                                id="{{ $data->id }}"
                                value="{{ $data->area }}, {{ $data->landmark }}, {{ $data->pincode }}, {{ $data->city }}, {{ $data->state }}"
                                required>
                            <label class="form-check-label" for="{{ $data->id }}">
                                {{ $data->area }}, {{ $data->landmark }}, {{ $data->pincode }},{{ $data->city }},
                                {{ $data->state }} </label> <br>
                            <button type="submit"
                                class="btn btn-primary  shadow border-success text-white mt-3 col-sm-6 col-md-4 col-lg-2"
                                id="payment">Deliver Here</button>
                        </div>
                        <input type="hidden" name="access_token" value="{{ csrf_token() }}">

                    </div>

                </form>
            @endforeach

            <button type="button" class="btn btn-primary shadow border-success text-white mt-3 col-sm-6 col-md-4 col-lg-2"
                onclick="document.getElementById('new-address-form').style.display='block';">Add New Address</button>

            <form action="{{ url('add-address') }}" method="post" id="new-address-form" style="display: none;">
                @csrf

                @if ($errors->any())
                    <input type="hidden" id="has-errors" value="1">
                @endif

                <div class="form-group mt-4">
                    <label for="number">Phone Number</label>
                    <input id="number" class="block mt-1 w-full" type="number" name="phone"
                        value="{{ old('phone') }}" autocomplete="username">
                </div>
                <span class="text-danger">
                    @error('phone')
                        {{ $message }}
                    @enderror
                </span>
                <div class="form-group mt-4">
                    <label for="inputState" class="text-dark" name="state">Select Your State:</label>

                    <select class="form-control shadow border-dark bottom-select" id="inputState" name="state"
                        onchange="updateCities()">
                        <option value="SelectState">Select State</option>
                        <option value="Andra Pradesh">Andra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Madya Pradesh">Madya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Odisha">Odisha</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>

                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="West Bengal">West Bengal</option>
                        <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                        <option value="Chandigarh">Chandigarh</option>
                        <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                        <option value="Daman and Diu">Daman and Diu</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Lakshadweep">Lakshadweep</option>
                        <option value="Pondicherry">Pondicherry</option>
                    </select>

                </div>
                <span class="text-danger">
                    @error('state')
                        {{ $message }}
                    @enderror
                </span>
                <div class="form-group mt-4">
                    <label for="inputDistrict" class="text-dark">Select Your City:</label>

                    <select class="form-control shadow border-dark" id="inputCity" name="city">
                        <option value="">-- select one -- </option>
                    </select>

                </div>
                <span class="text-danger">
                    @error('city')
                        {{ $message }}
                    @enderror
                </span>
                <div class="form-group mt-4">
                    <label for="area">Street or area</label>
                    <input id="area" class="block mt-1 w-full" type="text" name="area"
                        value="{{ old('area') }}" autocomplete="username">
                </div>
                <span class="text-danger">
                    @error('area')
                        {{ $message }}
                    @enderror
                </span>

                <div class="form-group">
                    <label for="landmark">Landmark</label>
                    <input id="landmark" class="block mt-1 w-full col-12" type="text" name="landmark"
                        value="{{ old('landmark') }}" autofocus autocomplete="name">

                </div>
                <span class="text-danger">
                    @error('landmark')
                        {{ $message }}
                    @enderror
                </span>

                <div class="form-group mt-4">
                    <label for="pincode">Pin Code</label>
                    <input id="pincode" class="block mt-1 w-full" type="number" min="1" name="pincode"
                        value="{{ old('pincode') }}" autocomplete="username">
                </div>
                <span class="text-danger">
                    @error('pincode')
                        {{ $message }}
                    @enderror
                </span> <br>
                <button type="submit"
                    class="btn btn-primary  shadow border-success text-white mt-3 col-sm-6 col-md-4 col-lg-2"
                    id="payment">Add Address</button>
            </form>

        </div>
    </div>
    </div>
@endsection

<script>
    window.onload = function() {
        // Check if there are validation errors and display the form if true
        if (document.getElementById('has-errors')) {
            document.getElementById('new-address-form').style.display = 'block';
        }
    };
</script>
<script>
    function updateCities() {
        var AndraPradesh = ["Anantapur", "Chittoor", "East Godavari", "Guntur", "Kadapa", "Krishna", "Kurnool",
            "Prakasam", "Nellore", "Srikakulam", "Visakhapatnam", "Vizianagaram", "West Godavari"
        ];
        var ArunachalPradesh = ["Anjaw", "Changlang", "Dibang Valley", "East Kameng", "East Siang", "Kra Daadi",
            "Kurung Kumey", "Lohit", "Longding", "Lower Dibang Valley", "Lower Subansiri", "Namsai", "Papum Pare",
            "Siang", "Tawang", "Tirap", "Upper Siang", "Upper Subansiri", "West Kameng", "West Siang", "Itanagar"
        ];
        var Assam = ["Baksa", "Barpeta", "Biswanath", "Bongaigaon", "Cachar", "Charaideo", "Chirang", "Darrang",
            "Dhemaji", "Dhubri", "Dibrugarh", "Goalpara", "Golaghat", "Hailakandi", "Hojai", "Jorhat",
            "Kamrup Metropolitan", "Kamrup (Rural)", "Karbi Anglong", "Karimganj", "Kokrajhar", "Lakhimpur",
            "Majuli", "Morigaon", "Nagaon", "Nalbari", "Dima Hasao", "Sivasagar", "Sonitpur",
            "South Salmara Mankachar", "Tinsukia", "Udalguri", "West Karbi Anglong"
        ];
        var Bihar = ["Araria", "Arwal", "Aurangabad", "Banka", "Begusarai", "Bhagalpur", "Bhojpur", "Buxar",
            "Darbhanga", "East Champaran", "Gaya", "Gopalganj", "Jamui", "Jehanabad", "Kaimur", "Katihar",
            "Khagaria", "Kishanganj", "Lakhisarai", "Madhepura", "Madhubani", "Munger", "Muzaffarpur", "Nalanda",
            "Nawada", "Patna", "Purnia", "Rohtas", "Saharsa", "Samastipur", "Saran", "Sheikhpura", "Sheohar",
            "Sitamarhi", "Siwan", "Supaul", "Vaishali", "West Champaran"
        ];
        var Chhattisgarh = ["Balod", "Baloda Bazar", "Balrampur", "Bastar", "Bemetara", "Bijapur", "Bilaspur",
            "Dantewada", "Dhamtari", "Durg", "Gariaband", "Janjgir-Champa", "Jashpur", "Kabirdham", "Kanker",
            "Kondagaon", "Korba", "Koriya", "Mahasamund", "Mungeli", "Narayanpur", "Raigarh", "Raipur",
            "Rajnandgaon", "Sukma", "Surajpur", "Surguja"
        ];
        var Goa = ["North Goa", "South Goa"];
        var Gujarat = ["Ahmedabad", "Amreli", "Anand", "Aravalli", "Banaskantha", "Bharuch", "Bhavnagar", "Botad",
            "Chhota Udaipur", "Dahod", "Dang", "Devbhoomi Dwarka", "Gandhinagar", "Gir Somnath", "Jamnagar",
            "Junagadh", "Kheda", "Kutch", "Mahisagar", "Mehsana", "Morbi", "Narmada", "Navsari", "Panchmahal",
            "Patan", "Porbandar", "Rajkot", "Sabarkantha", "Surat", "Surendranagar", "Tapi", "Vadodara", "Valsad"
        ];
        var Haryana = ["Ambala", "Bhiwani", "Charkhi Dadri", "Faridabad", "Fatehabad", "Gurugram", "Hisar", "Jhajjar",
            "Jind", "Kaithal", "Karnal", "Kurukshetra", "Mahendragarh", "Mewat", "Palwal", "Panchkula", "Panipat",
            "Rewari", "Rohtak", "Sirsa", "Sonipat", "Yamunanagar"
        ];
        var HimachalPradesh = ["Bilaspur", "Chamba", "Hamirpur", "Kangra", "Kinnaur", "Kullu", "Lahaul-Spiti", "Mandi",
            "Shimla", "Sirmaur", "Solan", "Una"
        ];
        var JammuKashmir = ["Anantnag", "Bandipora", "Baramulla", "Budgam", "Doda", "Ganderbal", "Jammu", "Kargil",
            "Kathua", "Kishtwar", "Kulgam", "Kupwara", "Leh", "Poonch", "Pulwama", "Rajouri", "Ramban", "Reasi",
            "Samba", "Shopian", "Srinagar", "Udhampur"
        ];
        var Jharkhand = ["Bokaro", "Chatra", "Deoghar", "Dhanbad", "Dumka", "East Singhbhum", "Garhwa", "Giridih",
            "Godda", "Gumla", "Hazaribagh", "Jamtara", "Khunti", "Koderma", "Latehar", "Lohardaga", "Pakur",
            "Palamu", "Ramgarh", "Ranchi", "Sahebganj", "Seraikela Kharsawan", "Simdega", "West Singhbhum"
        ];
        var Karnataka = ["Bagalkot", "Bangalore Rural", "Bangalore Urban", "Belgaum", "Bellary", "Bidar", "Vijayapura",
            "Chamarajanagar", "Chikkaballapur", "Chikkamagaluru", "Chitradurga", "Dakshina Kannada", "Davanagere",
            "Dharwad", "Gadag", "Gulbarga", "Hassan", "Haveri", "Kodagu", "Kolar", "Koppal", "Mandya", "Mysore",
            "Raichur", "Ramanagara", "Shimoga", "Tumkur", "Udupi", "Uttara Kannada", "Yadgir"
        ];
        var Kerala = ["Alappuzha", "Ernakulam", "Idukki", "Kannur", "Kasaragod", "Kollam", "Kottayam", "Kozhikode",
            "Malappuram", "Palakkad", "Pathanamthitta", "Thiruvananthapuram", "Thrissur", "Wayanad"
        ];
        var MadhyaPradesh = ["Agar Malwa", "Alirajpur", "Anuppur", "Ashoknagar", "Balaghat", "Barwani", "Betul",
            "Bhind", "Bhopal", "Burhanpur", "Chhatarpur", "Chhindwara", "Damoh", "Datia", "Dewas", "Dhar",
            "Dindori", "Guna", "Gwalior", "Harda", "Hoshangabad", "Indore", "Jabalpur", "Jhabua", "Katni",
            "Khandwa", "Khargone", "Mandla", "Mandsaur", "Morena", "Narsinghpur", "Neemuch", "Panna", "Raisen",
            "Rajgarh", "Ratlam", "Rewa", "Sagar", "Satna", "Sehore", "Seoni", "Shahdol", "Shajapur", "Sheopur",
            "Shivpuri", "Sidhi", "Singrauli", "Tikamgarh", "Ujjain", "Umaria", "Vidisha"
        ];
        var Maharashtra = ["Ahmednagar", "Akola", "Amravati", "Aurangabad", "Beed", "Bhandara", "Buldhana",
            "Chandrapur", "Dhule", "Gadchiroli", "Gondia", "Hingoli", "Jalgaon", "Jalna", "Kolhapur", "Latur",
            "Mumbai City", "Mumbai Suburban", "Nagpur", "Nanded", "Nandurbar", "Nashik", "Osmanabad", "Palghar",
            "Parbhani", "Pune", "Raigad", "Ratnagiri", "Sangli", "Satara", "Sindhudurg", "Solapur", "Thane",
            "Wardha", "Washim", "Yavatmal"
        ];
        var Manipur = ["Bishnupur", "Chandel", "Churachandpur", "Imphal East", "Imphal West", "Jiribam", "Kakching",
            "Kamjong", "Kangpokpi", "Noney", "Pherzawl", "Senapati", "Tamenglong", "Tengnoupal", "Thoubal", "Ukhrul"
        ];
        var Meghalaya = ["East Garo Hills", "East Khasi Hills", "Jaintia Hills", "Ri Bhoi", "West Garo Hills",
            "West Jaintia Hills", "West Khasi Hills"
        ];
        var Mizoram = ["Aizawl", "Champhai", "Kolasib", "Lawngtlai", "Lunglei", "Mamit", "Saiha", "Serchhip"];
        var Nagaland = ["Dimapur", "Kiphire", "Kohima", "Longleng", "Mokokchung", "Mon", "Peren", "Phek", "Tuensang",
            "Wokha", "Zunheboto"
        ];
        var Odisha = ["Angul", "Bargarh", "Boudh", "Cuttack", "Dhenkanal", "Ganjam", "Gajapati", "Jagatsinghpur",
            "Jajpur", "Jharsuguda", "Kalahandi", "Kandhamal", "Kendrapara", "Kendujhar", "Koraput", "Malkangiri",
            "Nabarangpur", "Nayagarh", "Nuapada", "Rayagada", "Sambalpur", "Sonepur", "Subarnapur", "Sundargarh"
        ];
        var Punjab = ["Amritsar", "Barnala", "Bathinda", "Faridkot", "Fatehgarh Sahib", "Fazilka", "Mansa", "Moga",
            "Muktsar", "Patiala", "Rupnagar", "S.A.S. Nagar", "Sangrur", "Tarn Taran"
        ];
        var Rajasthan = ["Ajmer", "Alwar", "Banswara", "Baran", "Barmer", "Bharatpur", "Bhilwara", "Bikaner", "Bundi",
            "Chittorgarh", "Churu", "Dausa", "Dholpur", "Dungarpur", "Hanumangarh", "Jaipur", "Jaisalmer", "Jalore",
            "Jhalawar", "Jhunjhunu", "Jodhpur", "Karauli", "Kota", "Nagaur", "Pali", "Rajasthan", "Sikar", "Sirohi",
            "Tonk", "Udaipur"
        ];
        var Sikkim = ["East Sikkim", "North Sikkim", "South Sikkim", "West Sikkim"];
        var TamilNadu = ["Ariyalur", "Chengalpattu", "Chennai", "Coimbatore", "Cuddalore", "Dharmapuri", "Dindigul",
            "Erode", "Kallakurichi", "Kanchipuram", "Kanyakumari", "Karur", "Krishnagiri", "Madurai",
            "Nagapattinam", "Namakkal", "Perambalur", "Pudukkottai", "Ramanathapuram", "Salem", "Sivaganga",
            "Tenkasi", "Thanjavur", "Theni", "Thoothukudi", "Tiruchirappalli", "Tirunelveli", "Tiruppur",
            "Tiruvallur", "Tiruvannamalai", "Vellore", "Viluppuram", "Virudhunagar"
        ];
        var Telangana = ["Adilabad", "Bhadradri Kothagudem", "Hyderabad", "Jagtial", "Jangaon",
            "Jayashankar Bhupalpally", "Jogulamba Gadwal", "Kamareddy", "Karimnagar", "Khammam", "Mahabubabad",
            "Mahabubnagar", "Mancherial", "Medak", "Medchal", "Nalgonda", "Nirmal", "Nizamabad", "Peddapalli",
            "Rajanna Sircilla", "Rangareddy", "Warangal (Rural)", "Warangal (Urban)"
        ];
        var Tripura = ["Dhalai", "Gomati", "Khowai", "North Tripura", "Sepahijala", "South Tripura", "Unakoti",
            "West Tripura"
        ];
        var UttarPradesh = ["Agra", "Aligarh", "Ambedkar Nagar", "Amethi", "Amroha", "Auraiya", "Azamgarh", "Barabanki",
            "Bareilly", "Basti", "Bhadohi", "Bijnor", "Budaun", "Bulandshahr", "Chandauli", "Chitrakoot", "Deoria",
            "Etah", "Etawah", "Faizabad", "Farrukhabad", "Fatehpur", "Firozabad", "Gautam Buddh Nagar", "Ghaziabad",
            "Ghazipur", "Gonda", "Gorakhpur", "Hamirpur", "Hapur", "Hardoi", "Hathras", "Jalaun", "Jaunpur",
            "Jhansi", "Kannauj", "Kanpur", "Kushinagar", "Lakhimpur Kheri", "Lalitpur", "Lucknow", "Maharajganj",
            "Mainpuri", "Mathura", "Mau", "Meerut", "Mirzapur", "Moradabad", "Muzaffarnagar", "Pilibhit",
            "Pratapgarh", "Raebareli", "Rampur", "Saharanpur", "Sambhal", "Sant Kabir Nagar", "Shahjahanpur",
            "Shamli", "Shravasti", "Siddharthnagar", "Sitapur", "Sonbhadra", "Sultanpur", "Unnao", "Varanasi"
        ];
        var Uttarakhand = ["Almora", "Bageshwar", "Chamoli", "Champawat", "Dehradun", "Haridwar", "Nainital",
            "Pauri Garhwal", "Pithoragarh", "Rudraprayag", "Tehri Garhwal", "Uttarkashi"
        ];
        var WestBengal = ["Bankura", "Birbhum", "Burdwan", "Cooch Behar", "Dakshin Dinajpur", "Darjeeling", "Hooghly",
            "Howrah", "Jalpaiguri", "Jhargram", "Kalimpong", "Kolkata", "Maldah", "Murshidabad", "Nadia",
            "North 24 Parganas", "Paschim Medinipur", "Purba Medinipur", "Purulia", "South 24 Parganas",
            "Uttar Dinajpur"
        ];

        var state = document.getElementById("inputState").value;
        var cities = [];

        // Determine cities based on the selected state
        switch (state) {
            case "Andra Pradesh":
                cities = AndraPradesh;
                break;
            case "Arunachal Pradesh":
                cities = ArunachalPradesh;
                break;
            case "Assam":
                cities = Assam;
                break;
            case "Bihar":
                cities = Bihar;
                break;
            case "Chhattisgarh":
                cities = Chhattisgarh;
                break;
            case "Goa":
                cities = Goa;
                break;
            case "Gujarat":
                cities = Gujarat;
                break;
            case "Haryana":
                cities = Haryana;
                break;
            case "Himachal Pradesh":
                cities = HimachalPradesh;
                break;
            case "Jammu Kashmir":
                cities = JammuKashmir;
                break;
            case "Jharkhand":
                cities = Jharkhand;
                break;
            case "Karnataka":
                cities = Karnataka;
                break;
            case "Kerala":
                cities = Kerala;
                break;
            case "Madhya Pradesh":
                cities = MadhyaPradesh;
                break;
            case "Maharashtra":
                cities = Maharashtra;
                break;
            case "Manipur":
                cities = Manipur;
                break;
            case "Meghalaya":
                cities = Meghalaya;
                break;
            case "Mizoram":
                cities = Mizoram;
                break;
            case "Nagaland":
                cities = Nagaland;
                break;
            case "Odisha":
                cities = Odisha;
                break;
            case "Punjab":
                cities = Punjab;
                break;
            case "Rajasthan":
                cities = Rajasthan;
                break;
            case "Sikkim":
                cities = Sikkim;
                break;
            case "Tamil Nadu":
                cities = TamilNadu;
                break;
            case "Telangana":
                cities = Telangana;
                break;
            case "Tripura":
                cities = Tripura;
                break;
            case "Uttar Pradesh":
                cities = UttarPradesh;
                break;
            case "Uttarakhand":
                cities = Uttarakhand;
                break;
            case "West Bengal":
                cities = WestBengal;
                break;
            default:
                cities = [];
        }

        // Update the cities dropdown
        var cityDropdown = document.getElementById("inputCity");
        cityDropdown.innerHTML = ""; // Clear existing options

        for (var i = 0; i < cities.length; i++) {
            var option = document.createElement("option");
            option.value = cities[i];
            option.text = cities[i];
            cityDropdown.add(option);
        }
    }
</script>
