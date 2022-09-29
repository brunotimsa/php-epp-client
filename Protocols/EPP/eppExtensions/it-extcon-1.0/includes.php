<?php
$this->addExtension('it-extcon-1.0', 'http://www.nic.it/ITNIC-EPP/extcon-1.0');

include_once(dirname(__FILE__) . '/eppRequests/itEppCreateContactRequest.php');
$this->addCommandResponse('Metaregistrar\EPP\itEppCreateContactRequest', 'Metaregistrar\EPP\eppCreateContactResponse');

include_once(dirname(__FILE__) . '/eppResponses/itEppCreateContactResponse.php');
$this->addCommandResponse('Metaregistrar\EPP\eppCreateContactRequest', 'Metaregistrar\EPP\itEppCreateContactResponse');
