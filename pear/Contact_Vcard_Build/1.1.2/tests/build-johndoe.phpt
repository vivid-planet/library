--TEST--
A test to build a john doe vcard included in examples.
--SKIPIF--
<?php
include_once 'Contact/Vcard/Build.php';
if (!class_exists('Contact_Vcard_Build')) {
    die('SKIP This test requires Contact_Vcard_Build.');
}
--FILE--
<?php
require_once 'Contact/Vcard/Build.php';

$vcard = new Contact_Vcard_Build();
$vcard->setFormattedName('John Doe');

$vcard->setName('John', '', 'Doe', '', '');
$vcard->addEmail('johnDoe@example.org');
$vcard->addParam('TYPE', 'WORK');

$vcard->addTelephone('+1 617 555 1212');
$vcard->addParam('TYPE', 'WORK');
$vcard->addParam('TYPE', 'PREF');

$vcard->addTelephone('+1 (617) 555-1234');
$vcard->addParam('TYPE', 'WORK');

$vcard->addTelephone('+1 781 555 1212');
$vcard->addParam('TYPE', 'CELL');

$vcard->addTelephone('+1 202 555 1212');
$vcard->addParam('TYPE', 'HOME');

$pob      = '';
$extend   = '';
$street   = '2 Enterprise Avenue';
$locality = '';
$region   = 'NY';
$postcode = '01111';
$country  = 'USA';

$vcard->addAddress($pob, $extend, $street, $locality, $region,
    $postcode, $country);
$vcard->addParam('TYPE', 'WORK');

$pob      = '';
$extend   = '';
$street   = '3 Acacia Avenue';
$locality = 'Hoemtown';
$region   = 'MA';
$postcode = '02222';
$country  = 'USA';

$vcard->addAddress($pob, $extend, $street, $locality, $region,
    $postcode, $country);
$vcard->addParam('TYPE', 'HOME');

$note  = 'John Doe has a long and varied history, being documented on more police';
$note .= ' files that anyone else. Reports of his death are alas numerous.';

$vcard->setNote($note);

$vcard->setUrl('http://www.example/com/doe');

$vcard->addCategories('Work');
$vcard->addCategories('Test group');

$text = $vcard->fetch();
var_dump($text);
--EXPECT--
string(543) "BEGIN:VCARD
VERSION:3.0
PROFILE:VCARD
FN:John Doe
N:John;;Doe;;
ADR;TYPE=WORK:;;2 Enterprise Avenue;;NY;01111;USA
ADR;TYPE=HOME:;;3 Acacia Avenue;Hoemtown;MA;02222;USA
TEL;TYPE=WORK,PREF:+1 617 555 1212
TEL;TYPE=WORK:+1 (617) 555-1234
TEL;TYPE=CELL:+1 781 555 1212
TEL;TYPE=HOME:+1 202 555 1212
EMAIL;TYPE=WORK:johnDoe@example.org
CATEGORIES:Work,Test group
NOTE:John Doe has a long and varied history\, being documented on more poli
 ce files that anyone else. Reports of his death are alas numerous.
URL:http://www.example/com/doe
END:VCARD
"
