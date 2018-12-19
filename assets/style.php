<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/13/18
 * Time: 2:26 AM
 */

echo '<meta charset="utf-8">
      <link rel="stylesheet" href="' . get_site_url() . '/wp-content/plugins/submit-code/assets/code-editor/theme/material.css">
      <link rel="stylesheet" href="' . get_site_url() . '/wp-content/plugins/submit-code/assets/code-editor/lib/codemirror.css">
      <script src="' . get_site_url() . '/wp-content/plugins/submit-code/assets/code-editor/lib/codemirror.js"></script>
      <script src="' . get_site_url() . '/wp-content/plugins/submit-code/assets/code-editor/mode/javascript/javascript.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      ';

echo '<style>
            .accepted{
                font-weight: bold;
                color: green;
                height: 0px;
            }
            .wrong{
                font-weight: bold;
                color: red;
                height: 0px;
            }
            .wrong_detail{
                height: 0px;
                font-size: 12px;
                margin-left: 16px;
            }
            .compilation_error{
                height: 150px;
                font-size: 12px;
                overflow-x: hidden;
                overflow-y: scroll;
                background: black;
                color: white;
                padding: 5px 10px 10px 10px;
            }
            .CodeMirror{
                border: 0px solid #263238;
                border-radius: 5px;
                position: initial;
                width: 100%;
                height: 450px;
                resize: vertical;
            }
            .submit-code-btn{
                background: #263238;
                color: white;
                width: 80px;
                height: 40px;
                text-align: center;
                border-radius: 5px;
                margin-top: 20px;
                border: 0px solid;             
            }
            .lang_id {
                background: #263238;
                color: white;
                width: 200px;
                height: 40px;
                border: 0px solid #263238;
                border-radius: 5px;
                margin-right: 10px;
                -moz-appearance:none; /* Firefox */
                -webkit-appearance:none; /* Safari and Chrome */
                appearance:none;
            }
            .pre-result {
                font-size: 12px;
                padding-top: 6px;
                padding-bottom: 5px;
                background: white;
            }
            .result-title {
                font-weight: bold;
            }
     </style>';
