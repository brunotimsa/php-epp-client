<?php

namespace Metaregistrar\EPP;
/*
<?xml version="1.0" encoding="UTF-8"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="urn:ietf:params:xml:ns:epp-1.0 epp-1.0.xsd">
   <command>
      <create>
         <contact:create xmlns:contact="urn:ietf:params:xml:ns:contact-1.0" xsi:schemaLocation="urn:ietf:params:xml:ns:contact-1.0  contact-1.0.xsd">
            <contact:id>mr0001</contact:id>
            <contact:postalInfo type="loc">
               <contact:name>Mario Rossi</contact:name>
               <contact:addr>
                  <contact:street>Via Moruzzi 1</contact:street>
                  <contact:city>Pisa</contact:city>
                  <contact:sp>PI</contact:sp>
                  <contact:pc>56124</contact:pc>
                  <contact:cc>IT</contact:cc>
               </contact:addr>
            </contact:postalInfo>
            <contact:voice x="2111">+39.050315</contact:voice>
            <contact:fax>+39.0503152593</contact:fax>
            <contact:email>mario.rossi@esempio.it</contact:email>
            <contact:authInfo>
               <contact:pw />
            </contact:authInfo>
         </contact:create>
      </create>
      <extension>
         <extcon:create xmlns:extcon="http://www.nic.it/ITNIC-EPP/extcon-1.0" xsi:schemaLocation="http://www.nic.it/ITNIC-EPP/extcon1.0 extcon-1.0.xsd">
            <extcon:consentForPublishing>true</extcon:consentForPublishing>
         </extcon:create>
      </extension>
      <clTRID>ABC-12345</clTRID>
   </command>
</epp>
*/

class itEppCreateContactRequest extends eppRequest
{
    function __construct($contact, $namespacesinroot = true)
    {
        parent::__construct($contact, $namespacesinroot = true);
        $this->additExtension($contact);
    }

    public function additExtension($contact)
    {
        $create = $this->createElement('create');
        $contact_create = $this->createElement('contact:create');
        $contact_create->setAttribute('xmlns:contact', 'urn:ietf:params:xml:ns:contact-1.0');
        $contact_create->setAttribute('xsi:schemaLocation', 'urn:ietf:params:xml:ns:contact-1.0 contact-1.0.xsd');
        $contact_create->appendChild($this->createElement('contact:id', $contact['id']));
        $postal_info = $this->createElement('contact:postalInfo');
        $postal_info->setAttribute('type', 'loc');
        $postal_info->appendChild($this->createElement('contact:name', $contact['postalInfo']['name']));
        $addr = $this->createElement('contact:addr');
        $addr->appendChild($this->createElement('contact:street', $contact['postalInfo']['addr']['street']));
        $addr->appendChild($this->createElement('contact:city', $contact['postalInfo']['addr']['city']));
        $addr->appendChild($this->createElement('contact:sp', $contact['postalInfo']['addr']['sp']));
        $addr->appendChild($this->createElement('contact:pc', $contact['postalInfo']['addr']['pc']));
        $addr->appendChild($this->createElement('contact:cc', $contact['postalInfo']['addr']['cc']));
        $postal_info->appendChild($addr);
        $contact_create->appendChild($postal_info);
        $contact_create->appendChild($this->createElement('contact:voice', $contact['postalInfo']['voice']));
        $contact_create->appendChild($this->createElement('contact:email', $contact['postalInfo']['email']));
        $auth_info = $this->createElement('contact:authInfo');
        $auth_info->appendChild($this->createElement('contact:pw'));
        $contact_create->appendChild($auth_info);
        $create->appendChild($contact_create);
        $this->getCommand()->appendChild($create);

        $extension = $this->createElement('extension');
        $extcon_create = $this->createElement('extcon:create');
        $extcon_create->setAttribute('xmlns:extcon', 'http://www.nic.it/ITNIC-EPP/extcon-1.0');
        $extcon_create->setAttribute('xsi:schemaLocation', 'http://www.nic.it/ITNIC-EPP/extcon-1.0 extcon-1.0.xsd');
        $extcon_create->appendChild($this->createElement('extcon:consentForPublishing', $contact['consentForPublishing']));
        $extcon_registrant = $this->createElement('extcon:registrant');
        $extcon_registrant->appendChild($this->createElement('extcon:nationalityCode', $contact['registrant']['nationalityCode']));
        $extcon_registrant->appendChild($this->createElement('extcon:entityType', $contact['registrant']['entityType']));
        $extcon_registrant->appendChild($this->createElement('extcon:regCode', $contact['registrant']['regCode']));
        $extension->appendChild($extcon_create);
        $this->getCommand()->appendChild($extension);


        $this->getEpp()->setAttribute('xmlns', 'urn:ietf:params:xml:ns:epp-1.0');
        $this->getEpp()->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $this->getEpp()->setAttribute('xsi:schemaLocation', 'urn:ietf:params:xml:ns:epp-1.0 epp-1.0.xsd');
    }
}
