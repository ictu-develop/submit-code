<?php
$json = '{
      "id": "100005950149538",
      "name": "Nguyễn Minh Đức",
      "birthday": "02/25/1997",
      "email": "duc2521997@gmail.com",
      "devices": [
        {
          "hardware": "iPhone",
          "os": "iOS"
        }
      ]
    }';

$arrray = json_decode($json,true); //conver to Arrray
echo $arrray['name'];
echo $arrray['devices'][0]['hardware'].'<br>';

$obj = json_decode($json); //conver to Object
echo $obj->name;
echo $obj->devices[0]->hardware;
?>