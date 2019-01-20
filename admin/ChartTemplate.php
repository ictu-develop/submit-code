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
        echo '<p class="font-weight-bold ml-3 visitor_submit">Submit Total::</p>';
        echo '<p class="font-weight-bold ml-3 correct">Correct:</p>';
        echo '<p class="font-weight-bold ml-3 incorrect">Incorrect:</p>';
        // End content
        echo '</div>';
        //
        echo '<script>    
                    function getDate() {
                        let date = new Date();
                        let d = date.getDate();
                        let m = date.getMonth() + 1;
                        let y = date.getFullYear();
                        
                        if (d.length < 2) 
                            d = "0" + d; 
                        if (m.length < 2) 
                            m = "0" + m;
                    
                        return y+"-"+m+"-"+d;
                    }
                </script>';
        echo '<script>
            $.ajax({
                method: "GET",
                url: "'.get_site_url().'/wp-content/plugins/submit-code/admin/request/requestDashBoardInDay.php?date=" + getDate()
            })
            .done(async function(data) {
                console.log(data);
                $(".day-loading").hide();
                $(".visitor_submit").text("Submit Total: " + data.submit_total);
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
            $this->dashBroadChart();
            echo '<script>
                var x_bar = [];
                var y_bar_visitor_submit = [];
                var y_bar_date_correct = [];
                var y_bar_date_incorrect = [];
                
                $.ajax({
                    method: "GET",
                    url: "'.get_site_url().'/wp-content/plugins/submit-code/admin/request/requestDashBoardInLast7Day.php"
                })
                .done(async function(data) {
                    console.log(data);
                    $(".day-loading").hide();
                    for (let i=data.length  -1; i>=0 ; i--) {
                        x_bar.push(data[i].date);
                        y_bar_visitor_submit.push(data[i].submit_total);
                        y_bar_date_correct.push(data[i].correct);
                        y_bar_date_incorrect.push(data[i].incorrect);
                    }
                    last7DayChart()
                })
                .fail(async function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                });
            </script>';
            // End content
        echo '</div>';
        echo '</div>';
    }

    function dashBroadChart()
    {
        echo '<canvas id="dashboard-in-day-chart" width="50" height="15"></canvas>';
        echo '<script>
            function last7DayChart() {
                var ctx = document.getElementById("dashboard-in-day-chart");
                var color = Chart.helpers.color;
                
                var myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: x_bar,
                        datasets: [{
                            label: "Submit last 7 day",
                            data: y_bar_visitor_submit,
                            fill: false,
                            backgroundColor: [
                                "rgba(0, 94, 255, 1)"
                            ],
                            borderColor: [
                                "rgba(0, 94, 255, 1)"
                            ],
                            borderWidth: 0.5
                        },
                        {
                            label: "Correct last 7 day",
                            data: y_bar_date_correct,
                            fill: false,
                            backgroundColor: [
                                "rgba(68, 255, 0, 1)"
                            ],
                            borderColor: [
                                "rgba(68, 255, 0, 1)"
                            ],
                            borderWidth: 0.5
                        },
                        {
                            label: "Incorrect last 7 day",
                            data: y_bar_date_incorrect,
                            fill: false,
                            backgroundColor: [
                                "rgba(255, 0, 0, 1)"
                            ],
                            borderColor: [
                                "rgba(255, 0, 0, 1)"
                            ],
                            borderWidth: 0.5
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
            }
            </script>';
    }
}