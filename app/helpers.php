<?php 
function getDateFormat($date)
{
    if (empty($date)) {
        return null;
    }
    return date_format($date, "d-m-Y H:i");
}