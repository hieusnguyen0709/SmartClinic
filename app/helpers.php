<?php 
function getTimeFormat($time)
{
    if (empty($time)) {
        return null;
    }
    return substr($time, 0, 5);;
}