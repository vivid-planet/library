--TEST--
For bug: #15348
--CREDITS--
Sixto Martín <smartin at yaco dot es>
--SKIPIF--
<?php
@include_once 'Contact/Vcard/Parse.php';
@include_once 'Contact/Vcard/Build.php';
if (!class_exists('Contact_Vcard_Parse')) {
    die('SKIP This test requires Contact_Vcard_Parse');
}
if (!class_exists('Contact_Vcard_Build')) {
    die('SKIP This test requires Contact_Vcard_Build');
}
--FILE--
<?php
// set to CVS's
//$buildDir = realpath(dirname(__FILE__) . '/../');
//$parseDir = realpath(dirname(__FILE__) . '/../../Contact_Vcard_Parse');
//set_include_path($buildDir . ':' . $parseDir . ':' . get_include_path());

// report all errors
error_reporting(E_ALL);

// include the class file
require_once 'Contact/Vcard/Parse.php';
require_once 'Contact/Vcard/Build.php';

// instantiate a parser object
$parse = new Contact_Vcard_Parse();
$vcard = new Contact_Vcard_Build();


$vcard_text = <<<EOVCARD
BEGIN:VCARD
VERSION:3.0
N:Frank Dawson
FN:Frank Dawson
URL:http://home.earthlink.net/~fdawson
END:VCARD
EOVCARD;

// parse it
$data = $parse->fromText($vcard_text, true);

// build it
$vcard->setFromArray($data[0]);

// print builded vcard
$text = trim($vcard->fetch());

// compare
var_dump($text, $vcard_text);
--EXPECT--
string(121) "BEGIN:VCARD
VERSION:3.0
PROFILE:VCARD
FN:Frank Dawson
N:Frank Dawson;;;;
URL:http://home.earthlink.net/~fdawson
END:VCARD"
string(103) "BEGIN:VCARD
VERSION:3.0
N:Frank Dawson
FN:Frank Dawson
URL:http://home.earthlink.net/~fdawson
END:VCARD"
