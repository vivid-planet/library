--TEST--
A test to make sure email addresses are added to a vcard.
--CREDITS--
Taken from docs.
--SKIPIF--
<?php
include_once 'Contact/Vcard/Build.php';
if (!class_exists('Contact_Vcard_Build')) {
    die('SKIP Requires Contact_Vcard_Build.');
}
--FILE--
<?php
//set_include_path(realpath(dirname(__FILE__) . '/../') . ':' . get_include_path());
require_once 'Contact/Vcard/Build.php';

$vcard = new Contact_Vcard_Build(); // default 3.0
$vcard->setFormattedName('Till Klampaeckel');

// set the structured name parts
$vcard->setName('Till', 'F', 'Klampaeckel', 'Herr', '');
$vcard->addEmail('till@my.work.email');
$vcard->addParam('TYPE', 'WORK');

$vcard->addEmail('till@php.net');
$vcard->addParam('TYPE', 'HOME');
$vcard->addParam('TYPE', 'PREF');

$text = $vcard->fetch();
var_dump($text);
--EXPECT--
string(164) "BEGIN:VCARD
VERSION:3.0
PROFILE:VCARD
FN:Till Klampaeckel
N:Till;F;Klampaeckel;Herr;
EMAIL;TYPE=WORK:till@my.work.email
EMAIL;TYPE=HOME,PREF:till@php.net
END:VCARD
"
