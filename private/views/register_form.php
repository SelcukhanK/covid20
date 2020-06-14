<?php $this->layout('website') ?>


    <style>
        .card-header{
            background-color: #8dd6ca;
        }
        .card-header h2{
            color: white;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff; 
            border-bottom: 1px solid #d4d4d4; 
        }

        .autocomplete-items div:hover {
            background-color: #e9e9e9; 
        }

        .autocomplete-active {
            background-color: DodgerBlue !important; 
            color: #ffffff; 
        }
    </style>

<div class="container-fluid w-100 d-flex justify-content-center yarrag align-items-center hulpverlener-foto">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Registreren</h2>
                </div>
                <div class="card-body">
                    <form autocomplete="off" action="<?php echo url("register.handle")?>" method="POST">
                        <div class="flex">
                            <div class="form-group">
                                <label for="firstname">Voornaam</label>
                                <input type="text" placeholder="bv. Broodje" autocomplete="fname" name="firstname" id="firstname" class="form-control" value="<?php echo input('firstname') ?>" required autofocus>
                                <?php if ( isset( $errors['firstname'] ) ): ?>
                                    <?php echo $errors['firstname'] ?>
                                <?php endif;?>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Achternaam</label>
                                <input type="text" placeholder="bv. Ekmek" autocomplete="lname" name="lastname" id="lastname" class="form-control" value="<?php echo input('lastname') ?>" required>
                                <?php if ( isset( $errors['lastname'] ) ): ?>
                                    <?php echo $errors['lastname'] ?>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" placeholder="bv. broodje@ekmek.ekmek" name="email" id="email" class="form-control" value="<?php echo input('email') ?>" aria-describedby="emailHelp" required>
                                <?php if ( isset( $errors['email'] ) ): ?>
                                    <?php echo $errors['email'] ?>
                                <?php endif;?>
                                </div>
                            <div class="form-group">
                                <label for="wachtwoord">Wachtwoord</label>
                                <input type="password" placeholder="bv. Ekmek420" name="wachtwoord" class="form-control" id="wachtwoord" required>
                                <?php if ( isset( $errors['wachtwoord'] ) ): ?>
                                    <?php echo $errors['wachtwoord'] ?>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="form-group">
                                <label for="postcode">Postcode</label>
                                <input type="text" placeholder="bv. 1337 BE" name="postcode" id="postcode" class="form-control" value="<?php echo input('postcode') ?>" required>
                                <?php if ( isset( $errors['postcode'] ) ): ?>
                                    <?php echo $errors['postcode'] ?>
                                <?php endif;?>
                            </div>
                            <div class="form-group">
                                <label for="straatnaam">Straatnaam</label>
                                <input type="text" placeholder="bv. Br. Ekmekplein 420" name="straatnaam" id="straatnaam" class="form-control" value="<?php echo input('straatnaam') ?>" required>
                                <?php if ( isset( $errors['straatnaam'] ) ): ?>
                                    <?php echo $errors['straatnaam'] ?>
                                <?php endif;?>
                            </div>
                        </div>  
                        <div class="flex">  
                            <div class="form-group">
                                <label for="stad">Stad</label>
                                <input type="text" placeholder="bv. Ekmekdağ" name="stad" id="stad" class="form-control" value="<?php echo input('stad') ?>" required>
                                <?php if ( isset( $errors['stad'] ) ): ?>
                                    <?php echo $errors['stad'] ?>
                                <?php endif;?>
                            </div>
                            <div class="form-group autocomplete">
                                <label for="land">Land</label>
                                <input type="text" placeholder="bv. Ekmekistan" name="land" id="land" class="form-control" value="<?php echo input('land') ?>" required>
                                <?php if ( isset( $errors['land'] ) ): ?>
                                    <?php echo $errors['land'] ?>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <small id="emailHelp" class="form-text text-muted ml-5">We delen uw e-mail adres met niemand, uw gegevens zijn veilig!</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Registreren</button>
                        <a href="<?php echo url('login.form') ?>" class="btn btn-link">Ik heb al een account</a>
                    </form>

                    <script>
                        function autocomplete(inp, arr) {

                        var currentFocus;

                        inp.addEventListener("input", function(e) {
                            var a, b, i, val = this.value;

                            closeAllLists();
                            if (!val) { return false;}
                            currentFocus = -1;

                            a = document.createElement("DIV");
                            a.setAttribute("id", this.id + "autocomplete-list");
                            a.setAttribute("class", "autocomplete-items");

                            this.parentNode.appendChild(a);

                            for (i = 0; i < arr.length; i++) {
                            
                            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                                
                                b = document.createElement("DIV");
                                
                                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                                b.innerHTML += arr[i].substr(val.length);
                                
                                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                                
                                b.addEventListener("click", function(e) {
                                
                                    inp.value = this.getElementsByTagName("input")[0].value;

                                    closeAllLists();
                                });
                                a.appendChild(b);
                            }
                            }
                        });

                        inp.addEventListener("keydown", function(e) {
                            var x = document.getElementById(this.id + "autocomplete-list");
                            if (x) x = x.getElementsByTagName("div");
                            if (e.keyCode == 40) {

                                currentFocus++;

                            addActive(x);
                            } else if (e.keyCode == 38) { 
                            currentFocus--;
                            addActive(x);
                            } else if (e.keyCode == 13) {

                            e.preventDefault();
                            if (currentFocus > -1) {
                        
                                if (x) x[currentFocus].click();
                            }
                            }
                        });
                        function addActive(x) {

                        if (!x) return false;
                        
                        removeActive(x);
                        if (currentFocus >= x.length) currentFocus = 0;
                        if (currentFocus < 0) currentFocus = (x.length - 1);

                        x[currentFocus].classList.add("autocomplete-active");
                        }
                        function removeActive(x) {

                        for (var i = 0; i < x.length; i++) {
                            x[i].classList.remove("autocomplete-active");
                        }
                        }
                        function closeAllLists(elmnt) {
                        
                        var x = document.getElementsByClassName("autocomplete-items");
                        for (var i = 0; i < x.length; i++) {
                            if (elmnt != x[i] && elmnt != inp) {
                            x[i].parentNode.removeChild(x[i]);
                            }
                        }
                        }

                        document.addEventListener("click", function (e) {
                            closeAllLists(e.target);
                        });
                        }


                        var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

                        autocomplete(document.getElementById("land"), countries);
                    </script>
                </div>
            </div>
        </div>
    </div>