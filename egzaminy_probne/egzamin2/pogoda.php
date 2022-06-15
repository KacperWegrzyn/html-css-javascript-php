<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prognoza pogody Wrocław</title>
    <link rel="stylesheet" href="styl2.css">
</head>
<body>
    <header>
        <section class="lewy_i_prawy_blok_banera"><img src="logo.png" alt="meteo"></section>
        <section id="srodkowy_blok_banera"><h1>Prognoza dla Wrocławia</h1></section>
        <section class="lewy_i_prawy_blok_banera"><p>maj, 2019 r.</p></section>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <td>DATA</td>
                    <td>TEMPERATURA W NOCY</td>
                    <td>TEMPERATURA W DZIEŃ</td>
                    <td>OPADY [mm/h]</td>
                    <td>CIŚNIENIE [hPa]</td>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $conn = mysqli_connect("localhost", "root", "", "egzaminy_probne");

                    $sql = "SELECT * FROM `pogoda` WHERE miasta_id = 1 ORDER BY data_prognozy ASC";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr><td>".$row['data_prognozy']."</td><td>".$row['temperatura_noc']."</td><td>".$row['temperatura_dzien']."</td><td>".$row['opady']."</td><td>".$row['cisnienie']."</td></tr>";
                        }
                    }
                
                    mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </main>

    <section class="blok_lewy_i_prawy"><img src="obraz.jpg" alt="Polska, Wrocław"></section>
    <section class="blok_lewy_i_prawy"><a href="kwerendy.txt" download>Pobierz kwerendy</a></section>

    <footer><p>Stronę wykonał: 03222109652</p></footer>
</body>
</html>