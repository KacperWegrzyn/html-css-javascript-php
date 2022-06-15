<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wędkujemy</title>
    <link rel="stylesheet" href="styl_1.css">
</head>
<body>
    <header><h1>Portal dla wędkarzy</h1></header>

    <section id="lewy">
        <h2>Ryby drapieżne naszych wód</h2>
        <list>
            <ul>
                <?php
                    $conn = mysqli_connect("localhost", "root", "", "egzaminy_probne");

                    $sql = "SELECT nazwa, wystepowanie FROM `ryby` WHERE styl_zycia = 1";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<li>".$row['nazwa'].", występowanie: ".$row['wystepowanie']."</li>";
                        }
                    }

                    mysqli_close($conn);
                ?>
            </ul>
        </list>
    </section>

    <section id="prawy">
        <img src="ryba1.jpg" alt="Sum"><br>
        <a href="kwerendy.txt">Pobierz kwerendy</a>
    </section>

    <footer><p>Stronę wykonał: 03222109652</p></footer>
</body>
</html>