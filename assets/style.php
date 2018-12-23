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
            .button-show-submit-history{
                background: #263238;
                color: white;
                width: 170px;
                height: 40px;
                text-align: center;
                border-radius: 5px;
                margin-top: 20px;
                border: 0px solid; 
                margin-bottom: 15px;
            }
            .submit-history-result-date{
                cursor: pointer;
                color: #263238;
                font-weight: bold;
                margin-bottom: 0px;
            }
            .submit-history-result-source{
                display: none;
                background-color: white;
                padding: 10px 0px 0px 10px;
                font-size: 14px;
            }
            .history-result-pass{
                font-weight: bold;
            }
            .submit-history-result {
                position: initial;
                width: 100%;
                height: 300px;
                overflow-y: scroll;
                overflow-x: hidden;    
                display: none;   
            }
     </style>';

// Modal css

echo '<style>
            body {font-family: Arial, Helvetica, sans-serif;}
            
            /* The Modal (background) */
            .modal {
              display: none; /* Hidden by default */
              position: fixed; /* Stay in place */
              z-index: 100; /* Sit on top */
              padding-top: 10px; /* Location of the box */
              left: 0;
              top: 0;
              width: 100%; /* Full width */
              height: 100%; /* Full height */
              overflow: auto; /* Enable scroll if needed */
              background-color: rgb(0,0,0); /* Fallback color */
              background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            }
            
            /* Modal Content */
            .modal-content {
              background-color: #fefefe;
              margin: auto;
              padding: 20px;
              border: 1px solid #888;
              width: 60%;
            }
            
            /* The Close Button */
            .close {
              color: #aaaaaa;
              float: right;
              font-size: 28px;
              font-weight: bold;
            }
            
            .close:hover,
            .close:focus {
              color: #000;
              text-decoration: none;
              cursor: pointer;
            }
      </style>';