<?php
setlocale(LC_ALL, 'en_US.UTF8');
date_default_timezone_set('Europe/Stockholm');

$data = file_get_contents('php://input');

if ($data) {
    $obj = json_decode($data);

    $log =  "===============".date("j/n/Y H:i:s")."===============\n";
    $log .= "Document URI: ".$obj->{'csp-report'}->{'document-uri'}."\n";
    $log .= "Referrer: ".$obj->{'csp-report'}->{'referrer'}."\n";
    $log .= "Violated Directive: ".$obj->{'csp-report'}->{'violated-directive'}."\n";
    $log .= "Original Policy: \"".$obj->{'csp-report'}->{'original-policy'}."\"\n";
    $log .= "Blocked URI: ".$obj->{'csp-report'}->{'blocked-uri'}."\n";

    file_put_contents("csp-violations.log", $log, FILE_APPEND | LOCK_EX);
}

?>