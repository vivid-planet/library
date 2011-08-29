--TEST--
Create a vcard 2.1 with ORG and different 'phones'.
--SKIPIF--
<?php
include_once 'Contact/Vcard/Build.php';
if (!class_exists('Contact_Vcard_Build')) {
    die('SKIP This test requires Contact_Vcard_Build.');
}
--FILE--
<?php
include_once 'Contact/Vcard/Build.php';
$vcard = new Contact_Vcard_Build('2.1');

$vcard = new Contact_Vcard_Build();
$vcard->setFormattedName('Bar Foo');
$vcard->setName('Bar', '', 'Foo', '', '');
$vcard->setTitle('FOOBAR');
$vcard->addOrganization('OHAI');

$vcard->addEmail('foobar@example.org');

$vcard->addTelephone('0900-foobar');
$vcard->addParam('TYPE', 'work');

$vcard->addTelephone('0900-foobar-cell');
$vcard->addParam('TYPE', 'cell');

$vcard->addTelephone('0900-foobar-fax');
$vcard->addParam('TYPE', 'fax');

var_dump($vcard->fetch());
--EXPECT--
string(205) "BEGIN:VCARD
VERSION:3.0
PROFILE:VCARD
FN:Bar Foo
N:Bar;;Foo;;
TEL;TYPE=work:0900-foobar
TEL;TYPE=cell:0900-foobar-cell
TEL;TYPE=fax:0900-foobar-fax
EMAIL:foobar@example.org
TITLE:FOOBAR
ORG:OHAI
END:VCARD
"
