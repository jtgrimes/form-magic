<?php

return array(
    "login"=>array(
        "method"=>"post",
        "url"=>"#",
        "fields"=>array(
            "username"=>array("type"=>"text","rules"=>"required"),
            "password"=>array("type"=>"password","rules"=>"required"),
            "remember"=>array("type"=>"checkbox")
        ),
    ),
);