<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/16/18
 * Time: 5:01 PM
 */

require 'collection/TestCase.php';

class SubmitCode
{
    private $test_case_array = [];
    private $lang_id = ['C (gcc 7.2.0)' => 4, 'C++ (g++ 7.2.0)' => 10, 'Java (JDK 9)' => 26, 'Go (1.9)' => 22, 'Python (3.6.0)' => 34];
    private $all_test_case = '';

    private function customTrim($input)
    {
        $result = str_replace("\r", '', $input);
        $result = str_replace("\t", '', $result);
        $result = str_replace("\0", '', $result);
        $result = str_replace("\x0B", '', $result);
        $result = str_replace("\\n", "\n", $result);
        $result = trim($result, "\n");
        return $result;
    }

    private function parseTestCase()
    {
        //echo $this->all_test_case.'<br>';
        $test_case = '';
        $i = 0;
        while ($i < strlen($this->all_test_case) - strlen('[/out]')) {
            if ($this->all_test_case[$i + 1] === '[' && $this->all_test_case[$i + 2] === '/' && $this->all_test_case[$i + 3] === 'o' &&
                $this->all_test_case[$i + 4] === 'u' && $this->all_test_case[$i + 5] === 't' && $this->all_test_case[$i + 6] === ']') {
                $test_case .= '[/out]';
                $test_case = trim($test_case);
                //echo $test_case.'<br>';
                $input = str_replace('[inp]', '', strstr($test_case, '[/inp]', true));
                $output = str_replace('[out]', '', str_replace('[/out]', '', strstr($test_case, '[out]', false)));
                $input = $this->customTrim($input);
                $output = $this->customTrim($output);
                $input = json_encode($input);
                $output = json_encode($output);
                $this->test_case_array[] = new TestCase($input, $output);
                $test_case = '';
                $i += strlen('[/out]') + strlen(' ');
            } else {
                $test_case .= $this->all_test_case[$i];
                $i++;
            }
        }
        /* foreach($this->test_case_array as $value){
             echo $value->input.'<br>';
             echo $value->output.'<br>';
         }*/

    }

    function addFilterContent()
    {
        add_filter('the_content', function ($content) {
            // init post, length
            $pos_start = 0;
            $pos_end = mb_strpos($content, '[test-case]');
            $pos_last = mb_strpos($content, '[/test-case]');
            $content_length = mb_strlen($content);
            $test_length = mb_strlen(mb_substr($content, $pos_end));

            if ($pos_end == false || $pos_last == false) {
                return $content;
            }

            if (is_single()) {
                require plugin_dir_path(__FILE__) . '../assets/style.php';
                $new_content = '';
                // test case string
                $this->all_test_case = mb_substr($content, $pos_end, $test_length);
                $this->all_test_case = str_replace('[test-case]', '', $this->all_test_case);
                $this->all_test_case = str_replace('[/test-case]', '', $this->all_test_case);
                trim($this->all_test_case);
                $this->parseTestCase();
                // content string without test case
                $content = mb_substr($content, $pos_start, $content_length - $test_length);
                $new_content .= $content;
                if (is_user_logged_in()) {
                    return $new_content;
                } else {
                    return $new_content;
                }
            } else {
                $content = mb_substr($content, $pos_start, $content_length - $test_length);
                return $content;
            }
        }, 0);

    }

    function addFilterSubmit()
    {
        add_filter('the_content', function ($content) {
            if (empty($this->all_test_case))
                return $content;

            echo $content;
            if (is_single() && is_user_logged_in()) {
                echo '<textarea id="code-editor" name="source" required></textarea>';
                echo '<select name="lang_id" class="lang_id">';
                foreach ($this->lang_id as $lang_name => $lang_id) {
                    if ($_COOKIE['lang_id'] == $lang_id)
                        echo '<option value="' . $lang_id . '" selected>' . $lang_name . '</option>';
                    else
                        echo '<option value="' . $lang_id . '">' . $lang_name . '</option>';
                }
                echo '</select>';
                echo '<button onclick="submit_code()" class="submit-code-btn">Submit</button>';
                echo '<p></p>';
                echo '<div class="submit-result"></div>';

                echo '<script>
                            var clicked = 0;
                            var input = new Array();
                            var output = new Array();
                        </script>';

                foreach ($this->test_case_array as $value) {
                    echo '<script> input.push(' . $value->input . ') </script>';
                    echo '<script> output.push(' . $value->output . ') </script>';
                }

                echo '<script>
                    var myCodeMirror = CodeMirror.fromTextArea(document.getElementById("code-editor"), {
                                            lineNumbers: true,
                                            theme: "material"
                                          });
                    
                    function b64DecodeUnicode(str) {
                        return decodeURIComponent(atob(str).split(\'\').map(function(c) {
                                return \'%\' + (\'00\' + c.charCodeAt(0).toString(16)).slice(-2);
                            }).join(\'\'));
                    }
                    
                    
                   function b64EncodeUnicode(str) {
                        return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
                            function toSolidBytes(match, p1) {
                                return String.fromCharCode(\'0x\' + p1);
                        }));
                    }
                    
                    async function submit_code() {
                        var source_code = myCodeMirror.getValue()
                        if (source_code !== "")
                            clicked++;
                        var count_unit_test = 1;
                        var total = input.length;
                        var pass = 0;
                        var err = 0;
                        await $(".submit-code-btn").css("color: while")
                        var lang_id = await $(".lang_id").find(":selected").val();
                        
                        if (clicked === 1) {
                            await $(".submit-code-btn").text("Wait...");

                            await $( ".submit-result" ).empty();
                            if (source_code != ""){
                                for (var i=0; i< input.length; i++){
                                    if (err === 1){
                                        break;
                                    }
                                    await $(".submit-result").append("<p class=accepted id=on-load-test>"+count_unit_test+". Running...</p>");
                                    await $.ajax({
                                              method: "POST",
                                              url: "' . get_site_url() . '/wp-content/plugins/submit-code/request/request.php",
                                              data: {
                                                  source: b64EncodeUnicode(source_code),
                                                  stdin: b64EncodeUnicode(input[i]),
                                                  expected_output: b64EncodeUnicode(output[i]),
                                                  lang_id: lang_id
                                               }
                                            })
                                          .done(async function(data) {
                                              var json = JSON.stringify(data);
                                              var dataJson = JSON.parse(json);
                                              var description = dataJson.status.description;
                                              var expected_output = output[i];
                                             
                                              console.log(dataJson);
                                              
                                              if (description === "Compilation Error"){
                                                    err = 1;      
                                                    var complite_output = b64DecodeUnicode(dataJson.compile_output);
                                                    await $("#on-load-test").remove();
                                                    await $(".submit-result").append("<p class=wrong>"+ description +"</p>");
                                                    await $(".submit-result").append("<p class=compilation_error>"+complite_output +"</p>");
                                              } else if (description !== "Accepted" && description !== "Wrong Answer"){
                                                    await $("#on-load-test").remove();
                                                    await $(".submit-result").append("<p class=wrong>"+ description +"</p>");
                                              }                    
                                                  
                                              if (description === "Accepted") {
                                                    pass++;
                                                    await $("#on-load-test").remove();
                                                    await $(".submit-result").append("<p class=accepted>"+count_unit_test+". "+ description +"</p>");                              
                                              }
                                              
                                              if (description === "Wrong Answer"){
                                                    var your_ouput = b64DecodeUnicode(dataJson.stdout.trim());
                                                    console.log(your_ouput)
                                                    await $("#on-load-test").remove();
                                                    await $(".submit-result").append("<p class=wrong>"+count_unit_test+". "+ description +"</p>");
                                                    await $(".submit-result").append("<pre class=pre-result><span class=result-title>Test Input:</span> \n" +
                                                                                    ""+input[i] +"\n" +
                                                                                    "<span class=result-title>Test Output:</span>\n"+expected_output+"\n" +
                                                                                    "<span class=result-title>Your Output:</span>\n"+your_ouput+"</pre>");
                                              } 
                                              
                                          })
                                          .fail(async function(jqXHR, textStatus, errorThrown) {
                                              err = 1;
                                              await $("#on-load-test").remove();
                                              await $(".submit-result").append("<p class=wrong>Please check your internet</p>");
                                              await $(".submit-code-btn").text("Submit");
                                              clicked = 0;
                                          });
                                    count_unit_test++;
                                }
                                
                                await $(".submit-result").append("<br><br>");
                                
                                if (pass < total/2)
                                    await $(".submit-result").append("<h4 class=Wrong> Passed: "+pass+"/"+total+"</h4>");
                                else
                                    await $(".submit-result").append("<h4 class=accepted> Passed: "+pass+"/"+total+"</h4>");
                                
                                await $("#on-load-test").remove();
                                await $(".submit-code-btn").text("Submit");
                                clicked = 0;
                            }
                        }
                    }
              </script>';
            } else {
                $suggestLogin = '<p>Bạn chưa đăng nhập? <b><a style="color: #364956" href="'.get_site_url().'/login">Đăng nhập </a></b>để Submit ngay!</p>';
                return $suggestLogin;
            }
        });
    }

}