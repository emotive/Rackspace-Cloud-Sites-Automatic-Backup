<?php
# common test utility functions
#

# re-implementation of PECL's http_date
#
function httpDate($ts=NULL)
{
    if (!$ts) {
        return gmdate("D, j M Y h:i:s T");
    } else {
        return gmdate("D, j M Y h:i:s T", $ts);
    }
}

# Specify a word length and any characters to exlude and return
# a valid UTF-8 string
#
function genUTF8($len=10, $excludes=array())
{
    # generates a random iso-8859-1 string and converts it to utf-8
    # skips a few bad eggs.  Some names should exclude other characters,
    # for example, Containers can't contain a '/' character, so that can
    # be passed in with the $excludes array.
    $invalid_chars = array(
        127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,
        143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,
        );
    $skip_list = array_merge($invalid_chars, $excludes);
    $r = "";
    while (strlen($r) < $len) {
        $c = rand(32,255);
        if (in_array($c, $skip_list)) { continue; }
        $r .= chr($c);
    }
    return utf8_encode($r);
}

# generate a big string
#
function big_string($length)
{
    $r = array();
    for ($i=0; $i < $length; $i++) {
        $r[] = "a";
    }
    return join("", $r);
}

?>
