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
        require_once 'style/lib.php';
        lib();
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

    function today()
    {
        echo '<div class="row">';
        echo '<div class="col-4">';
        echo '<nav class="navbar navbar-light bg-light mb-4">
                  <span class="navbar-brand mb-0 h1 font-weight-bold">Today</span>';
        echo '</nav>';
        // Start content
        echo '<p class="ml-3 text-center day-loading">Loading:</p>';
        echo '<p class="font-weight-bold ml-3 total_submit_day">Submit Total:</p>';
        echo '<p class="font-weight-bold ml-3 correct_day">Correct:</p>';
        echo '<p class="font-weight-bold ml-3 incorrect_day">Incorrect:</p>';
        echo '<p class="font-weight-bold ml-3 visitor_submit_day">Visitor submit:</p>';
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
                url: "' . get_site_url() . '/wp-content/plugins/submit-code/admin/request/requestDashBoardInDay.php?date=" + getDate()
            })
            .done(async function(data) {
                console.log(data);
                $(".day-loading").hide();
                $(".total_submit_day").text("Submit Total: " + data.submit_total);
                $(".correct_day").text("Correct: " + data.correct);
                $(".incorrect_day").text("Incorrect: " + data.incorrect);
                $(".visitor_submit_day").text("Visitor submit: " + data.visitor_submit);
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
                  <span class="navbar-brand mb-0 h1 font-weight-bold">Last 7 days</span>';
        echo '</nav>';
        // Start content
        // End content
        $this->last7DayChart();
        echo '<script>
                var x_bar = [];
                var y_bar_total_submit = [];
                var y_bar_date_correct = [];
                var y_bar_date_incorrect = [];
                var y_bar_visitor_submit = [];
                
                $.ajax({
                    method: "GET",
                    url: "' . get_site_url() . '/wp-content/plugins/submit-code/admin/request/requestDashBoardInLast7Day.php"
                })
                .done(async function(data) {
                    console.log(data);
                    $(".day-loading").hide();
                    for (let i=data.length  -1; i>=0 ; i--) {
                        x_bar.push(data[i].date);
                        y_bar_total_submit.push(data[i].submit_total);
                        y_bar_date_correct.push(data[i].correct);
                        y_bar_date_incorrect.push(data[i].incorrect);
                        y_bar_visitor_submit.push(data[i].visitor_submit);
                    }
                    last7DayChart()
                })
                .fail(async function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                });
            </script>';
        echo '</div>';
        echo '</div>';
    }

    function last7DayChart()
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
                            label: "Submit",
                            data: y_bar_total_submit,
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
                            label: "Correct",
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
                            label: "Incorrect",
                            data: y_bar_date_incorrect,
                            fill: false,
                            backgroundColor: [
                                "rgba(255, 0, 0, 1)"
                            ],
                            borderColor: [
                                "rgba(255, 0, 0, 1)"
                            ],
                            borderWidth: 0.5
                        },
                        {
                            label: "Visitor",
                            data: y_bar_visitor_submit,
                            fill: false,
                            backgroundColor: [
                                "rgba(195, 37, 239, 1)"
                            ],
                            borderColor: [
                                "rgba(195, 37, 239, 1)"
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

    function total()
    {
        echo '<div class="row mt-5">';
        echo '<div class="col-4">';
        echo '<nav class="navbar navbar-light bg-light mb-4">
                  <span class="navbar-brand mb-0 h1 font-weight-bold">Total</span>';
        echo '</nav>';
        // Start content
        echo '<p class="ml-3 text-center total-loading">Loading:</p>';
        echo '<p class="font-weight-bold ml-3 submit_total">Submit Total::</p>';
        echo '<p class="font-weight-bold ml-3 correct_total">Correct:</p>';
        echo '<p class="font-weight-bold ml-3 incorrect_total">Incorrect:</p>';
        echo '<p class="font-weight-bold ml-3 visitor_submit_total">Visitor submit:</p>';
        // End content
        echo '</div>';
        //
        echo '<script>
            $.ajax({
                method: "GET",
                url: "' . get_site_url() . '/wp-content/plugins/submit-code/admin/request/requestDashBroadTotal.php"
            })
            .done(async function(data) {
                console.log(data);
                $(".total-loading").hide();
                $(".submit_total").text("Submit Total: " + data.submit_total);
                $(".correct_total").text("Correct: " + data.correct);
                $(".incorrect_total").text("Incorrect: " + data.incorrect);
                $(".visitor_submit_total").text("Visitor submit: " + data.visitor_submit);
            })
            .fail(async function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            });
        </script>';
    }

    function top_post()
    {
        echo '<div class="col">';
        echo '<nav class="navbar navbar-light bg-light mb-4">
                  <span class="navbar-brand mb-0 h1 font-weight-bold">Top post</span>';
        echo '</nav>';
        // Start content
        echo '<div class="row h-50">';
        echo '<div class="col top_post_content">';
        echo '<table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Post title</th>
                      <th scope="col">Submit</th>
                    </tr>
                  </thead>
                  <tbody class="tbody">
                  </tbody>      
              </table>';
        echo '</div>';
        echo '</div>';
        // End content
        echo '<script>
            let post_index= 0;
            $.ajax({
                method: "GET",
                url: "' . get_site_url() . '/wp-content/plugins/submit-code/admin/request/requestTopPost.php"
            })
            .done(async function(data) {
                console.log(data);
                for (let i=0; i<data.length; i++) {
                    $(".tbody").append("<tr><td>" + post_index + "</td><td><a href=" + data[i].post_link + "  target=_blank>" + data[i].post_title + "</a></td><td>" + data[i].total + "</td></tr>");
                    post_index++;
                } 
            })
            .fail(async function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            });
        </script>';
        echo '</div>';
        echo '</div>';
    }
}