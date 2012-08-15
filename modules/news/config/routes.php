<?php

$route["news/(:num)"] = "news/index/$1";

$route["news/list/(:any)"] = "news/full_list/$1";
$route["news/list"]        = "news/full_list";
$route["news/print/(:num)"] = "news/printt/$1";
$route["news/print/(:num)/(:num)"] = "news/printt/$1/$2";