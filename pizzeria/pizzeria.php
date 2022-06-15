<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body{font-family: lato; background-image: url('img/tlo.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%;}
        .produkt{width: 294px; height: 500px; background-color: lightgrey; float: left; margin: 10px; text-align: center; opacity: 90%; box-shadow: 0px 0px 3px 3px black;}
        .k_produkt{width: 294px; height: 550px; background-color: lightgrey; float: left; margin: 10px; text-align: center; opacity: 90%; box-shadow: 0px 0px 3px 3px black;}
        .img{width: 294px; height: 200px;}
        #menu{height: 70px; background-color: #d1a54d; margin: 10px; box-shadow: 0px 0px 3px 3px black;}
        #lista{width: 70px; height: 70px; padding: 15px;}
        .ikona{width: 40px; height: 40px;}
        .dodaj{width: 260px; height: 30px;}
        #cienKoszyka{width: 100%; height: 1000%; background-color: black; opacity: 50%; position: absolute; margin: -10px; display: none;}
        #tloKoszyka{width: 1300px; background-color: white; position: absolute; margin-left: 300; padding: 20px; display: none;}
        #X{width: 50px; height: 50px; position: absolute; display: none; background-color: white; border-style: none;}
        #zamow{width: 200px; height: 50px; background-color: #d1a54d; border-style: none; margin-left: auto; margin-right: auto; margin-bottom: 20px; display: none; box-shadow: 0px 0px 3px 3px black;}
        #poleKoszyka{display: none;}
        #kategorie{width: 100px; height: 30px; border-style: solid; border-width: 2px; border-color: grey; border-radius: 5px; background-color: lightgrey; margin-left: 20px; margin-top: 20px;}
        #kategorie * {width: 100px; height: 30px; border-style: solid; border-width: 2px; border-color: grey; border-radius: 5px; background-color: lightgrey;}
        .option{width: 100px; height: 30px; border-style: solid; border-width: 2px; border-color: grey; border-radius: 5px; background-color: lightgrey;}
        #koszyk{width: 100px; height: 30px; border-style: solid; border-width: 2px; border-color: grey; border-radius: 5px; background-color: lightgrey;}
        #imie{margin-left: 270px;}
        #wartoscZamowienia{margin-left: 540px;}
    </style>
    <script>
        $.ajax({
            type: "GET",
            url: "pizzeria.json",
            success:function(response){
                //zapelnianie strony
                for(i=0; i<response.pizzeria['0'].pizza.length; i++){
                    produkt = response.pizzeria['0'].pizza[i];
                    $("#div1").append('<div class="produkt"><img class="img" src="img/pizza/' + produkt.id + '.jpg"><h1>' + produkt.nazwa + '</h1><p>Składniki:<br>' + produkt.skladniki + '</p><br><p>Cena:<br>' + produkt.cena + ' zł</p><br><input type="button" class="dodaj" value="Dodaj do koszyka" id="' + produkt.id + '"></div>');
                }
                var rodzaj;

                $(document).on('change', '#kategorie', function(){
                    $("#div1").html("");
                    rodzaj = $("#kategorie").val();
                
                    if(rodzaj == "0"){
                        for(i=0; i<response.pizzeria[rodzaj].pizza.length; i++){
                            produkt = response.pizzeria[rodzaj].pizza[i];
                            $("#div1").append('<div class="produkt"><img class="img" src="img/pizza/' + produkt.id + '.jpg"><h1>' + produkt.nazwa + '</h1><p>Składniki:<br>' + produkt.skladniki + '</p><br><p>Cena:<br>' + produkt.cena + ' zł</p><br><input type="button" class="dodaj" value="Dodaj do koszyka" id="' + produkt.id + '"></div>');
                        }
                    }
                    if(rodzaj == "1"){
                        for(i=0; i<response.pizzeria[rodzaj].kebab.length; i++){
                            produkt = response.pizzeria[rodzaj].kebab[i];
                            $("#div1").append('<div class="produkt"><img class="img" src="img/kebab/' + produkt.id + '.jpg"><h1>' + produkt.nazwa + '</h1><p>Składniki:<br>' + produkt.skladniki + '</p><br><p>Cena:<br>' + produkt.cena + ' zł</p><br><input type="button" class="dodaj" value="Dodaj do koszyka" id="' + produkt.id + '"></div>');
                        }
                    }
                    if(rodzaj == "2"){
                        for(i=0; i<response.pizzeria[rodzaj].hotdog.length; i++){
                            produkt = response.pizzeria[rodzaj].hotdog[i];
                            $("#div1").append('<div class="produkt"><img class="img" src="img/hotdog/' + produkt.id + '.jpg"><h1>' + produkt.nazwa + '</h1><p>Składniki:<br>' + produkt.skladniki + '</p><br><p>Cena:<br>' + produkt.cena + ' zł</p><br><input type="button" class="dodaj" value="Dodaj do koszyka" id="' + produkt.id + '"></div>');
                        }
                    }
                    if(rodzaj == "3"){
                        for(i=0; i<response.pizzeria[rodzaj].napoje.length; i++){
                            produkt = response.pizzeria[rodzaj].napoje[i];
                            $("#div1").append('<div class="produkt"><img class="img" src="img/napoje/' + produkt.id + '.jpg"><h1>' + produkt.nazwa + '</h1><p><br><br>' + produkt.skladniki + '</p><br><p>Cena:<br>' + produkt.cena + ' zł</p><br><input type="button" class="dodaj" value="Dodaj do koszyka" id="' + produkt.id + '"></div>');
                        }
                    }
                });

                var produkt_id = 0;
                var doZaplaty = 0;
                var sumy = [];
                var duze = [];
                var u;
                var ilosc;
                var dodatki = "";

                var k_produkt_id = [];
                var k_id = [];
                var k_nazwa = [];
                var k_skladniki = [];
                var k_cena = [];
                var k_klasa = [];

                //dodawanie do koszyka
                $('body').on('click', '.dodaj', function(){
                    rodzaj = $("#kategorie").val();
                    id = this.id;
                    id--;
                
                    if(rodzaj == "0"){
                        produkt = response.pizzeria[rodzaj].pizza[id];
                        if(jQuery.inArray(produkt.id, k_id) === -1){
                            k_produkt_id.push(produkt_id);
                            k_id.push(produkt.id);
                            k_nazwa.push(produkt.nazwa);
                            k_skladniki.push(produkt.skladniki);
                            k_cena.push(produkt.cena);
                            k_klasa.push("pizza");
                        }
                    }
                        
                    if(rodzaj == "1"){
                        id -= 10;
                        produkt = response.pizzeria[rodzaj].kebab[id];
                        if(jQuery.inArray(produkt.id, k_id) === -1){
                            k_produkt_id.push(produkt_id);
                            k_id.push(produkt.id);
                            k_nazwa.push(produkt.nazwa);
                            k_skladniki.push(produkt.skladniki);
                            k_cena.push(produkt.cena);
                            k_klasa.push("kebab");
                        }
                    }

                    if(rodzaj == "2"){
                        id -= 20;
                        produkt = response.pizzeria[rodzaj].hotdog[id];
                        if(jQuery.inArray(produkt.id, k_id) === -1){
                            k_produkt_id.push(produkt_id);
                            k_id.push(produkt.id);
                            k_nazwa.push(produkt.nazwa);
                            k_skladniki.push(produkt.skladniki);
                            k_cena.push(produkt.cena);
                            k_klasa.push("hotdog");
                        }
                    }

                    if(rodzaj == "3"){
                        id -= 30;
                        produkt = response.pizzeria[rodzaj].napoje[id];
                        if(jQuery.inArray(produkt.id, k_id) === -1){
                            k_produkt_id.push(produkt_id);
                            k_id.push(produkt.id);
                            k_nazwa.push(produkt.nazwa);
                            k_skladniki.push(produkt.skladniki);
                            k_cena.push(produkt.cena);
                            k_klasa.push("napoje");
                        }
                    }

                    produkt_id++;
                });

                $("#zamow").click(function(){
                    alert('Zamówienie na nazwisko: ' + $('#imie').val() + ' ' + $('#nazwisko').val() + 
                        '\nWysłano na adres: ' + $('#adres').val() + ' ' + $('#kodPocztowy').val() +
                        '\nNumer kontaktowy: ' + $('#numerTelefonu').val() +
                        '\nDo zapłaty: ' + doZaplaty + ' zł');

                    sumy = [];
                    doZaplaty = 0;
                });

                //usuwanie z koszyka
                $('#poleKoszyka').on('click', '.uzk', function(){
                    id = this.id;
                    $('#produkt_' + id).remove();

                    u = k_produkt_id.splice(id, 1);
                    u = k_id.splice(id, 1);
                    u = k_nazwa.splice(id, 1);
                    u = k_skladniki.splice(id, 1);
                    u = k_cena.splice(id, 1);
                    u = k_klasa.splice(id, 1);

                    sumy[id] = 0;
                    doZaplaty = 0;

                    for(i=0; i<sumy.length; i++){
                        doZaplaty += sumy[i];
                    }

                    $("#wartoscZamowienia").html("Cena twojego zamówienia: " + doZaplaty + " zł");
                });

                //wyswietlanie koszyka
                $("#koszyk").click(function(){
                    $("#cienKoszyka").css("display", "block");
                    $("#tloKoszyka").css("display", "block");
                    $("#X").css("display", "block");
                    $("#zamow").css("display", "block");
                    $("#poleKoszyka").css("display", "block");

                    $("#poleKoszyka").html("");
                    
                    for(i=0; i<k_nazwa.length; i++){
                        if(k_klasa[i] == "pizza"){ 
                            dodatki =  '<input type="checkbox" name="sos" class="cb"><label for="sos"> Dodatkowy sos</label><br>';
                            dodatki += '<input type="checkbox" name="ser" class="cb"><label for="ser"> Podwójny ser</label><br>';
                            dodatki += '<input type="checkbox" name="ciasto" class="cb"><label for="ciasto"> Grubsze ciasto</label><br>';
                        }

                        if(k_klasa[i] == "kebab"){  
                            dodatki = '<input type="checkbox" name="warzywa" class="cb"><label for="warzywa"> Więcej warzyw</label><br>';
                            if(k_nazwa[i] != "Vege kebab"){
                                dodatki += '<input type="checkbox" name="mieso" class="cb"><label for="mieso"> Więcej mięsa</label><br><br>';
                            }
                            else{
                                dodatki += '<br><br>';
                            }
                        }

                        if(k_klasa[i] == "hotdog"){
                            dodatki =  '<input type="radio" id="maly_' + i + '" name="rb_' + i + '" class="rb" checked="checked"><label for="maly"> Mały hot dog</label><br>';
                            dodatki += '<input type="radio" id="duzy_' + i + '" name="rb_' + i + '" class="rb"><label for="duzy"> Duży hot dog</label><br><br>';
                        }

                        if(k_klasa[i] == "napoje"){
                            $("#poleKoszyka").append('<div class="k_produkt" id="produkt_' + k_produkt_id[i] + '"><img class="img" src="img/' + k_klasa[i] + '/' + k_id[i] + '.jpg"><h1>' + k_nazwa[i] + '</h1><p><br><br>' + k_skladniki[i] + '</p><br>' + dodatki + '<p>Cena:<br>' + k_cena[i] + ' zł</p><br><input type="number" class="ilosc" value="1" id="ilosc_' + i + '" min="0"><input type="button" class="uzk" id="' + k_produkt_id[i] + '" value="Usuń z koszyka"></div>');
                        }
                        else{
                            $("#poleKoszyka").append('<div class="k_produkt" id="produkt_' + k_produkt_id[i] + '"><img class="img" src="img/' + k_klasa[i] + '/' + k_id[i] + '.jpg"><h1>' + k_nazwa[i] + '</h1><p>Składniki:<br>' + k_skladniki[i] + '</p><br>' + dodatki + '<p>Cena:<br>' + k_cena[i] + ' zł</p><br><input type="number" class="ilosc" value="1" id="ilosc_' + i + '" min="0"><input type="button" class="uzk" id="' + k_produkt_id[i] + '" value="Usuń z koszyka"></div>');
                        }
                        
                        
                        dodatki = "";
                    }

                    sumy = [];
                    doZaplaty = 0;
                    for(i=0; i<k_cena.length; i++){
                        sumy.push(k_cena[i] * $('#ilosc_' + i).val());
                    }

                    for(i=0; i<sumy.length; i++){
                        doZaplaty += sumy[i];
                    }

                    $("#wartoscZamowienia").html("Cena twojego zamówienia: " + doZaplaty + " zł");
                });

                $("#X").click(function(){
                    $("#cienKoszyka").css("display", "none");
                    $("#tloKoszyka").css("display", "none");
                    $("#X").css("display", "none");
                    $("#zamow").css("display", "none");
                    $("#poleKoszyka").css("display", "none");
                });

                //zmienianie ilosci
                $("#poleKoszyka").on("change", ".ilosc", function(){
                    id = this.id.substring(6,7);
                    ilosc = $(this).val();

                    sumy[id] = k_cena[id] *  ilosc;
                    doZaplaty = 0;

                    for(i=0; i<sumy.length; i++){
                        doZaplaty += sumy[i];
                    }

                    $("#wartoscZamowienia").html("Cena twojego zamówienia: " + doZaplaty + " zł");
                });


                //dodatki
                $("#poleKoszyka").on("change", ".cb", function(){
                    if(this.checked){
                        doZaplaty += 2;
                    }

                    if(!this.checked){
                        doZaplaty -= 2;
                    }

                    $("#wartoscZamowienia").html("Cena twojego zamówienia: " + doZaplaty + " zł");
                });

                $("#poleKoszyka").on("change", ".rb", function(){
                    id = this.id.substring(5,6);
                    var _id = id; 
                    _id++;

                    if($("#maly_" + id).prop("checked")){
                        k_cena[id] -= 1.50;
                        sumy[id] -= 1.50;
                        dodatki =  '<input type="radio" id="maly_' + id + '" name="rb_' + id + '" class="rb" checked="checked"><label for="maly"> Mały hot dog</label><br>';
                        dodatki += '<input type="radio" id="duzy_' + id + '" name="rb_' + id + '" class="rb"><label for="duzy"> Duży hot dog</label><br><br>';
                    }

                    if($("#duzy_" + id).prop("checked")){
                        k_cena[id] += 1.50;
                        sumy[id] += 1.50;
                        dodatki =  '<input type="radio" id="maly_' + id + '" name="rb_' + id + '" class="rb"><label for="maly"> Mały hot dog</label><br>';
                        dodatki += '<input type="radio" id="duzy_' + id + '" name="rb_' + id + '" class="rb" checked="checked"><label for="duzy"> Duży hot dog</label><br><br>'; 
                    }

                    $('#produkt_' + id).remove();

                    if(_id < k_id.length){
                        $("#produkt_" + _id).before('<div class="k_produkt" id="produkt_' + k_produkt_id[id] + '"><img class="img" src="img/' + k_klasa[id] + '/' + k_id[id] + '.jpg"><h1>' + k_nazwa[id] + '</h1><p>Składniki:<br>' + k_skladniki[id] + '</p><br>' + dodatki + '<p>Cena:<br>' + k_cena[id] + ' zł</p><br><input type="number" class="ilosc" value="1" id="ilosc_' + id + '" min="0"><input type="button" class="uzk" id="' + k_produkt_id[id] + '" value="Usuń z koszyka"></div>');
                    }
                    else{
                        $("#poleKoszyka").append('<div class="k_produkt" id="produkt_' + k_produkt_id[id] + '"><img class="img" src="img/' + k_klasa[id] + '/' + k_id[id] + '.jpg"><h1>' + k_nazwa[id] + '</h1><p>Składniki:<br>' + k_skladniki[id] + '</p><br>' + dodatki + '<p>Cena:<br>' + k_cena[id] + ' zł</p><br><input type="number" class="ilosc" value="1" id="ilosc_' + id + '" min="0"><input type="button" class="uzk" id="' + k_produkt_id[id] + '" value="Usuń z koszyka"></div>');
                    }

                    doZaplaty = 0;

                    for(i=0; i<sumy.length; i++){
                        doZaplaty += sumy[i];
                    }

                    $("#wartoscZamowienia").html("Cena twojego zamówienia: " + doZaplaty + " zł");
                });
            }
        });
    </script>
</head>
<body>
    <div id="menu">
        <select id="kategorie">
            <option class="option" value="0" selected>Pizza</option>
            <option class="option" value="1">Kebab</option>
            <option class="option" value="2">Hot dog</option>
            <option class="option" value="3">Napoje</option>
        </select>
        <input type="button" id="koszyk" value="Koszyk">
    </div>
    <div id="div1"></div>

    <div id="cienKoszyka"></div>
    <div id="tloKoszyka">
        <button id="X"><img src="img/ikony/cancel.png" style="width: 30px; height: 30px;"></button>
        <form>
            <input type="submit" id="zamow" value="Zamów">
            <input type="text" placeholder="imię" id="imie" pattern="[A-Za-z]{1,20}">
            <input type="text" placeholder="nazwisko" id="nazwisko" pattern="[A-Za-z.-]{1,20}">
            <input type="text" placeholder="numer telefonu" id="numerTelefonu" pattern="[0-9]{9}">
            <input type="text" placeholder="adres" id="adres">
            <input type="text" placeholder="kod pocztowy" id="kodPocztowy" pattern="[0-9]{2}[-][0-9]{3}">
        </form>
        <p id="wartoscZamowienia"></p>
        <div id="poleKoszyka"></div>
    </div>
</body>