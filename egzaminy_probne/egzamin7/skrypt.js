let img = document.getElementsByClassName('img');
Array.from(img).forEach(i => {
    i.addEventListener("mouseover", ()=>{
        let src = i.getAttribute('src');
        src = src.split(".");
        nazwa = src[0];
        rozszerzenie = src[1];
        src = nazwa + "-szary." + rozszerzenie; 
        i.src = src;
    });

    i.addEventListener("mouseleave", ()=>{
        let src = i.getAttribute('src');
        src = src.split(".");
        nazwa = src[0].split("-");
        nazwa = nazwa[0];
        rozszerzenie = src[1];
        src = nazwa + "." + rozszerzenie; 
        i.src = src;
    });

    i.addEventListener("click", ()=>{
        let src = i.getAttribute('src');
        src = src.split(".");
        nazwa = src[0].split("-");
        nazwa = nazwa[0];
        rozszerzenie = src[1];
        src = nazwa + "." + rozszerzenie; 
        i.src = src;
        document.getElementById("duze_img").src = src;
    });
});

document.getElementById("dv").addEventListener("click", ()=>{
    def = "pobieranie wirusa rozpoczęte";
    napis = document.getElementById("napis");
    napis2 = document.getElementById("napis2");
    napis.innerHTML = def;
    interval = 300;
    kropki = 3;

    set = setInterval(()=>{
            napis.innerHTML += ".";
            kropki--;
            if(kropki < 0){
                napis.innerHTML = def;
                kropki = 3;
            }
    }, interval);

    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    async function pobieranie(){
        await sleep(700);
        napis2.innerHTML += "cmd_command/ipconfig:";
        await sleep(100);
        napis2.innerHTML +=  "<br> Connection-specific DNS Suffix  . :Link-local <br> IPv6 Address . . . . . : fe80::156d:18a3:a16b:fe29%43 <br> IPv4 Address. . . . . . . . . . . : 192.168.6.106 <br> Subnet Mask . . . . . . . . . . . : 255.255.255.0 <br> Default Gateway . . . . . . . . . : 192.168.8.1";
        dv.innerHTML = "Pobieraj wirusa"
        await sleep(700);
        napis2.innerHTML += "<br> downloading virus_trojan.exe";
        await sleep(1000);
        napis2.innerHTML += "<br> downloaded virus_trojan.exe";
        await sleep(300);
        napis2.innerHTML += "<br> downloading toxicMalware.exe";
        await sleep(1200);
        napis2.innerHTML += "<br> downloaded toxicMalware.exe";
        await sleep(500);
        napis2.innerHTML += "<br> virus succesfully installed on your device. Please read the readme.txt file";
        clearInterval(set);
        napis.innerHTML = "pobieranie wirusa zakończone";
    };

    pobieranie();
});