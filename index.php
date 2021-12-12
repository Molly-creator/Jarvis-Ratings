<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="./script.js" defer></script>
    <title>Jarvis Ratings</title>
</head>

<?php
require('./ratings.php');
$star = "<span id='star' class='material-icons'>&#xe838;</span>";
?>

<body>
    <div class="navbar">
        <nav>

            <ul>
                <li><a href="https://community-challenge.netlify.app/">
                        <h1 id="logo">community<span>challenge</span>
                    </a></h1>
                </li>
                <li><a href="#home">Introduction</a></li>
                <li><a href="#rating">Dashboards</a></li>
                <li><a href="#herzien">Improvements</a></li>
            </ul>
        </nav>
    </div>
    <div class="container">
    
        <section id="home">
            
            <h2><?php echo $star; ?>Introduction<?php echo $star; ?></h2>
            <h3>User ratings put to use</h3>
            <p>The <span>Community Challenge</span> from Bit-Academy dives deep into the user experience.
                Learning to code is made fun and productive in the Jarvis Universe where there are a variaty of exercises!
                To improve .... exercise ratings ... CSV-file to PHP object... Dashboard
               </p><p>
                <br>Data-points: <span><?php echo count($Bitdata) - 1; ?></span>
             </p>
            
            <p>
                <?php
                $ExerciseTitle = [];
                for ($i = 1; $i < count($Bitdata); $i++) {
                    array_push($ExerciseTitle, $Bitdata[$i][0]);
                }
                $UniqueExercises = array_unique($ExerciseTitle);
                echo "There are " . count($UniqueExercises) . " exercises in dataset: ";
                ?>
            <table id="exercises">
                <tr>
                    <th>Title exercise</th>
                </tr>
                <?php
                foreach ($UniqueExercises as $title) {
                    echo "<tr><td>$title</td></tr>";
                };
                ?>
            </table>

            <p>

            </p>
        </section>

        <section id="rating">

            <h2><?php echo"$star$star";?>Ratings<?php echo"$star$star";?></h2>
            <h3>Dashboard exercise rating</h3>
            <p>Object generates dashboard below.</p>
            <p>

            <div class="OverviewTable">
                <?php
                $DashBoard->showDashboard();
                ?>
            </div>




        </section>
        <section>
            <h3>Dashboard monthly rating distribution</h3>
            <form method="post">
                <label for="ExerciseRatings">Select exercise</label>
                <select name="ExerciseRatings" id="ExerciseRatings">
                    <option value="" disabled selected hidden>Maak een keuze</option>
                    <option value="FlexBox">Flex met boxen</option>
                    <option value="Commandline">Commandline commands</option>
                    <option value="ReadData">Read that data</option>
                    <option value="KattenWeb">Maak een kattenwebsite</option>
                    <option value="Hover">Hover kan je gaan</option>
                </select>
                <label for="ExerciseRatings">Select year</label>
                <select name="ExerciseRatings" id="ExerciseRatings">
                    <option value="" disabled selected hidden>Maak een keuze</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                
                </select>
                
                <input type="submit" name="submit" value="Load"></input>
            </form>

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
        <section id="herzien">

            <h2><?php echo "$star $star $star";?>Improving rates<?php echo "$star $star $star";?></h2>
            <p>On May 1 2021 the exercise <span>"Flex met boxen"</span> was revised. This greatly impacted user ratings.
            Below an table with informations (n-count, total amount, mean) from before may 1 2021 and after this date. The barplot to illustrate the distribution of ratings given.
       
            </p>

            <table id="tbl-PrePost">
                <tr>
                    <td></td>
                    <td>N-value</td>
                    <td>Total</td>
                    <td>Mean</td>
                </tr>
                <tr>
                    <td>PRE</td>
                    <td><?php echo $FlexPreN; ?></td>
                    <td><?php echo $FlexPreSum; ?></td>
                    <td><?php echo $FlexPreMean; ?></td>
                </tr>
                <tr>
                    <td>POST</td>
                    <td><?php echo $FlexPostN; ?></td>
                    <td><?php echo $FlexPostSum; ?></td>
                    <td><?php echo $FlexPostMean; ?></td>
                </tr>
            </table>

            <script>
                window.onload = function() {
                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        theme: "light2", // "light1", "light2", "dark1", "dark2"
                        axisX1: {
                            title: "Dataverdeling ratings voor 1 mei 2021"
                        },
                        axisX2: {
                            title: "Dataverdeling ratings na1 mei 2021"
                        },


                        axisYType: "secondary",
                        data: [{
                            type: "column",
                            showInLegend: true,
                            legendMarkerColor: "#6b87e8",
                            name: "Voor 1 mei",
                            dataPoints: [{
                                    y: <?php echo (empty($FlexPreDist[1])) ? 0 : ($FlexPreDist[1]); ?>,
                                    label: "1"
                                },
                                {
                                    y: <?php echo (empty($FlexPreDist[2])) ? 0 : ($FlexPreDist[2]); ?>,
                                    label: "2"
                                },
                                {
                                    y: <?php echo (empty($FlexPreDist[3])) ? 0 : ($FlexPreDist[3]); ?>,
                                    label: "3"
                                },
                                {
                                    y: <?php echo (empty($FlexPreDist[4])) ? 0 : ($FlexPreDist[4]); ?>,
                                    label: "4"
                                },
                                {
                                    y: <?php echo (empty($FlexPreDist[5])) ? 0 : ($FlexPreDist[5]); ?>,
                                    label: "5"
                                }
                            ]
                        }, {
                            type: "column",
                            axisYType: "secondary",
                            showInLegend: true,
                            legendMarkerColor: "mediumaquamarine",
                            name: "Na 1 mei",
                            dataPoints: [{
                                    y: <?php echo (empty($FlexPostDist[1])) ? 0 : ($FlexPostDist[1]); ?>,
                                    label: "1"
                                },
                                {
                                    y: <?php echo (empty($FlexPostDist[2])) ? 0 : ($FlexPostDist[2]); ?>,
                                    label: "2"
                                },
                                {
                                    y: <?php echo (empty($FlexPostDist[3])) ? 0 : ($FlexPostDist[3]); ?>,
                                    label: "3"
                                },
                                {
                                    y: <?php echo (empty($FlexPostDist[4])) ? 0 : ($FlexPostDist[4]); ?>,
                                    label: "4"
                                },
                                {
                                    y: <?php echo (empty($FlexPostDist[5])) ? 0 : ($FlexPostDist[5]); ?>,
                                    label: "5"
                                }
                            ]
                        }]
                    });

                    chart.render();
                };
            </script>

            <div id="chartContainer"></div>

            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        </section>
    </div>

</body>
<div class="footerbar">
    <footer>
        <ul>
            
            <li><a href="https://github.com/Molly-creator/Jarvis-Ratings"><img src="./icons8-github-24.png" alt="GitHub cat-icon">git</a></li>
            <span>Dorian van Buel</span>
        </ul>
</div>
</footer>

</html>