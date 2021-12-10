<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Jarvis Ratings</title>
</head>

<?php
require('./ratings.php');


?>

<body>
    <nav>
        
        <ul>
            <h1 id="logo">community<span>challenge</span></h1>
            <li><a href="#home">Vraag 1</a></li>
            <li><a href="#rating">Vraag 2</a></li>
            <li><a href="#herzien">vraag 3</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1>Jarvis Ratings</h1>
        <section class="home">
            <h2>Intro</h2>
            <h3>Hoeveel ratings zijn er totaal gegeven?</h3>
            <p>De <span>Community Challenge</span> van deze week gaat over de gebruikers beoordelingen van opdrachten uit Jarvis. Aangeleverd is een groot CSV bestand met ratings van een onbekend aantal opdrachten en hoeveelheid. Dit is een prima bestandstype om data in op slaan maar niet om deze te analyseren! Daarvoor zal ik eerst het CSV bestand omzetten naar een PHP array. Met handig gebruik van de php functie ```count``` is snel vast te stellen dat in de dataset
                <?php echo count($Bitdata) - 1; ?> beoordelingen aanwezig zijn. Vervolgens wil ik weten over welke opdrachten rating beschikbaar zijn.
            </p>
            <p>
                <?php
                $ExerciseTitle = [];
                for ($i = 1; $i < count($Bitdata); $i++) {
                    array_push($ExerciseTitle, $Bitdata[$i][0]);
                }
                $UniqueExercises = array_unique($ExerciseTitle);
                echo "Er zijn " . count($UniqueExercises) . " opdrachten in de Jarvis dataset: ";
                foreach ($UniqueExercises as $title) {
                    echo "<br>$title";
                };
                ?>
                <br><br>Nu we deze basis informatie tot onze beschikken hebben gaan we verder kijken naar de daadwerkelijke ratings van de opdrachten.
            </p>
        </section>

        <section class="rating">

            <h2>Ratings</h2>
            <h3>Overzicht van de gebruikers beoordelingen</h3>
            <p>Aan de achterkant van deze webpagina draait een php script. Hierin wordt de data in een object geladen. Door gebruik te maken van (associatieve) arrays is onderstaande tabel gevuld met de gegevens van Jarvis. De gegevens zijn verzameld van de vijf opdrachten. De meeste ratings zijn gegevens van de opdracht “Hover kan je gaan” en van de opdracht “Flex met boxen” zijn de minste beoordelingen. Deze twee opdrachten hebben daarnaast gemeen dat “Hover kan je gaan” de meeste 1-ster ratings heeft gekregen en ‘Flex met boxen de minste. Wat bovendien uit het oog springt is dat “Flex met boxen” bijzonder veel 5-sterren heeft gekregen. Het is daarom ook niet verbazend dat het gemiddelde ook hoger is bij deze opdracht. Over het algemeen liggen de waardes van de verschillende opdrachten bij elkaar, zo rond de 30 - 40 aantal per ster. </p>
            <h3>Laag beoordeelde opdrachten</h3>
            <p>Er zijn twee opdrachten met een gemiddelde dat lager ligt dan 3. Dit zijn <span>“Read that data”</span> ” met een gemiddelde van 2.92.
                en <span>“Maak een kattenwebsite”</span> met een gemiddelde van 2.99.</p>


            <div class="OverviewTable">

                <?php
                $DashBoard->showDashboard();
                ?>
            </div>
        </section>
        <section>
            <h3>Overzicht per opdracht</h3>
            <form method="post">
                <label for="ExerciseRatings">Selecteer een opdracht</label>
                <select name="ExerciseRatings" id="ExerciseRatings">
                    <option value="" disabled selected hidden>Maak een keuze</option>
                    <option value="FlexBox">Flex met boxen</option>
                    <option value="Commandline">Commandline commands</option>
                    <option value="ReadData">Read that data</option>
                    <option value="KattenWeb">Maak een kattenwebsite</option>
                    <option value="Hover">Hover kan je gaan</option>
                </select>
                <input type="submit" name="submit" value="Laad overzicht"></input>
            </form>


            <h3>Opdracht tabel</h3>
            <p>Door de dataset nog verder te filteren is de informatie om te zetten naar een overzichtstabel van de opdrachten afzonderlijk.
                Hierin is te zien hoe de beoordelingen over de maanden is verdeeld.
            </p>
            <div class="MonthTable">
                <?php

                if (isset($_POST['submit'])) {
                    if ($_POST["ExerciseRatings"] == "FlexBox") {
                        $DashBoard->displayMonthRatings('Flex met boxen');
                    } elseif ($_POST["ExerciseRatings"] == "Commandline") {
                        $DashBoard->displayMonthRatings('Commandline commands');
                    } elseif ($_POST["ExerciseRatings"] == "ReadData") {
                        $DashBoard->displayMonthRatings('Read that data');
                    } elseif ($_POST["ExerciseRatings"] == "KattenWeb") {
                        $DashBoard->displayMonthRatings('Maak een kattenwebsite');
                    } else {
                        $DashBoard->displayMonthRatings('Hover kan je gaan');
                    }
                }

                ?>
            </div>

        </section>
        <section class="herzien">
            <h2>Reden tot voor verbetering</h2>
            <p>Op 1 mei 2021 is de opdracht Flex met boxen herzien, heeft dat geleid tot betere ratings?
                Door de gegevens van de opdrachten te filteren op de specifieke opdracht <span>"Flex met boxen"</span> en de datum zijn er twee arrays ontstaan. Een de gemiddeldes van voor 1 mei 2021 en een met de ratings van erna. Hieronder zie je een tabel met daarin een kolom voor de n-waarde. Dit is het aantal beoordelingen. En het totaal, dat de som van alle ratings is. Hiermee is het gemiddelde uit te rekenen.
                Voor de herziening van de opdracht was het gemiddelde <span>2,74</span> en na de wijziging was het gemiddelde <span>4,27</span>.
                In het geval van deze opdracht heeft het veranderen van de opdracht het gemiddelde flink doen toenemen. Regelmatig de beoordelingen van de gebruikers analyseren is van belang om goed in te kunnen spelen op de gebruikerservaring.
            </p>

            <?php

            echo "<table>";
            echo "<tr><th></th><td>N-value</td><td>Total</td><td>Mean</td></th>";
            echo "<tr><th>Voor 3 mei</th><td>$FlexPreN</td><td>$FlexPreSum</td><td>$FlexPreMean</td></tr>";
            echo "<tr><th>Na 3 mei</th><td>$FlexPostN</td><td>$FlexPostSum</td><td>$FlexPostMean</td></tr>";
            echo "</table>";
            ?>

        </section>
    </div>
    <footer>
        <img src="./icons8-github-24.png" alt="GitHub cat-icon"><li><a href="https://github.com/Molly-creator/Jarvis-Ratings">Git</a></li>
        <span>Dorian van Buel</span>
    </footer>
</body>

</html>