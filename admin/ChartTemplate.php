<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20/01/2019
 * Time: 13:57
 */

class ChartTemplate
{

    function __construct()
    {
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>';
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js  "></script>';
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>';
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>';

        echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">';
        echo '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>';
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>';
        echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>';
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>';
    }

    function title()
    {
        echo '<div class="container">';
            echo '<div class="row-12 bg-secondary justify-content-center">';
                echo '<div class="col text-center">';
                    echo '<div class="p-3 mb-5 mt-2 bg-secondary text-white"><h3 class="mb-0">Submit Code DashBroad</h3></div>';
                echo '</div>';
            echo '</div>';
    }

    function dashBroadInDay()
    {
        echo '<div class="row ">';
            echo '<div class="col-4">';
                echo '<nav class="navbar navbar-light bg-light mb-4">
                  <span class="navbar-brand mb-0 h1 font-weight-bold">Today</span>';
                echo '</nav>';
                // Start content
                echo '<p class="ml-3 text-center day-loading">Loading:</p>';
                echo '<p class="font-weight-bold ml-3 visitor_submit">Visitor:</p>';
                echo '<p class="font-weight-bold ml-3 correct">Correct:</p>';
                echo '<p class="font-weight-bold ml-3 incorrect">Incorrect:</p>';
                // End content
            echo '</div>';
            //
        echo '<script>
            $.ajax({
                method: "GET",
                url: "'.get_site_url().'/wp-content/plugins/submit-code/admin/request/requestDashBoardInDay.php"
            })
            .done(async function(data) {
                console.log(data);
                $(".day-loading").hide();
                $(".visitor_submit").text("Visitor submit: " + data.visitor_submit);
                $(".correct").text("Correct: " + data.correct);
                $(".incorrect").text("Incorrect: " + data.incorrect);
            })
            .fail(async function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            });
        </script>';
    }

    function last7Day()
    {
        echo '<div class="col">';
            echo '<nav class="navbar navbar-light bg-light mb-4">
                  <span class="navbar-brand mb-0 h1 font-weight-bold">Last 7 day</span>';
            echo '</nav>';
            // Start content

            // End content
        echo '</div>';
        echo '</div>';
    }

    function dashBroadChart()
    {
        echo '<canvas id="dashboard-in-day-chart" width="50" height="10"></canvas>';
        echo '<script>
            var ctx = document.getElementById("dashboard-in-day-chart");
            
            var myChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                    datasets: [{
                        label: "Personal today",
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            "rgba(255, 99, 132, 0.2)"
                        ],
                        borderColor: [
                            "rgba(255,99,132,1)"
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
            </script>';
    }
}