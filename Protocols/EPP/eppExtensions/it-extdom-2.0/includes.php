<?php
$this->addExtension('it-extdom-2.0', 'http://www.nic.it/ITNIC-EPP/extdom-2.0');

include_once(dirname(__FILE__) . '/eppRequests/itEppCheckDomainRequest.php');
$this->addCommandResponse('Metaregistrar\EPP\itEppCheckDomainRequest', 'Metaregistrar\EPP\eppCheckDomainResponse');

include_once(dirname(__FILE__) . '/eppResponses/itEppCheckDomainResponse.php');
$this->addCommandResponse('Metaregistrar\EPP\eppCheckDomainRequest', 'Metaregistrar\EPP\itEppCheckDomainResponse');
