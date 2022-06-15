<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>piłka nożna</title>
    <link rel="stylesheet" href="styl2.css">
</head>
<body>
    <banner id="banner">
        <h3>Reprezentacja polski w piłce nożnej</h3>
        <img src="obraz1.jpg" alt="reprezentacja" id="img">
    </banner>

    <div id="div">
        <lewy id="lewy">
            <form method="post" action="">
                <select id="select" name="select">
                    <option value="Bramkarze" name="Bramkarze">Bramkarze</option>
                    <option value="Obrońcy" name="Obrońcy">Obrońcy</option>
                    <option value="Pomocnicy" name="Pomocnicy">Pomocnicy</option>
                    <option value="Napastnicy" name="Napastnicy">Napastnicy</option>
                </select>
                <button type="submit">Zobacz</button>
            </form>
            <img src="zad2.png" alt="piłka">
            <p>Autor: Kacper Węgrzyn</p>
        </lewy>

        <prawy id="prawy">
            <list>
                <ol>
                    <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'egzamin');

                        $select = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
                        $id = 1;

                        switch($select){
                            case "Bramkarze":
                                $id = 1;
                                break;
                            case "Obrońcy":
                                $id = 2;
                                break;
                            case "Pomocnicy":
                                $id = 3;
                                break;
                            case "Napastnicy":
                                $id = 4;
                                break;
                        }

                        $sql = "SELECT imie, nazwisko FROM `zawodnik` WHERE pozycja_id=".$id;
                        $query = mysqli_query($conn, $sql);
                        $rows = mysqli_num_rows($query);

                        if($rows > 0){
                            while($row = mysqli_fetch_assoc($query)){
                                echo "<li><p>".$row['imie']." ".$row['nazwisko']."</p></li>";
                            }
                        }

                        mysqli_close($conn);
                    ?>
                </ol>
            </list>
        </prawy>
    </div>

    <main id="main">
        <h3>Liga mistrzów</h3>
    </main>

    <liga>
        <?php 
            $conn = mysqli_connect('localhost', 'root', '', 'egzamin');

            $sql = "SELECT zespol, punkty, grupa FROM `liga` ORDER BY punkty DESC";
            $query = mysqli_query($conn, $sql);
            $rows = mysqli_num_rows($query);

            if($rows > 0){
                while($row = mysqli_fetch_assoc($query)){
                    echo "<section>";
                        echo "<h2>".$row['zespol']."</h2>";
                        echo "<h1>".$row['punkty']."</h1>";
                        echo "<p>grupa: ".$row['grupa']."</p>";
                    echo "</section>";
                }
            }

            mysqli_close($conn);
        ?>
    </liga>




</body>
</html>