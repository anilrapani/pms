<?php
echo 2%60;
echo "<pre>";
function minutes_to_hours_n_minutes($number, $divider) {
  $arr['hours'] = str_pad((floor($number / $divider)), 2, 0, STR_PAD_LEFT);
  $arr['minutes'] = str_pad(($number % $divider), 2, 0, STR_PAD_LEFT); ;
  return $arr;
}

divisible_times(60,60);


echo date('H:i', mktime(0,1441));


  echo $code = mt_rand(1000,10000).time().mt_rand(1000,10000);
  echo "<br>".strlen($code);