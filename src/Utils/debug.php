<?php

declare(strict_types=1);
namespace ToDoApp;
error_reporting(E_ALL);
ini_set('display_errors', '1');
function dump($data) : void
{
    echo "<pre><div style='
    background-color:#bbb;
    border:1px dashed black;
    padding: 5px 10px;
    display: inline-block;
    '>$data</div></pre>";
}
