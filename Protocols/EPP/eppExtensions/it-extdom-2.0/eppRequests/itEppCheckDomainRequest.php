<?php

namespace Metaregistrar\EPP;
/*
<?xml version="1.0" encoding="UTF-8"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="urn:ietf:params:xml:ns:epp-1.0 epp-1.0.xsd">
   <command>
      <check>
         <domain:check xmlns:domain="urn:ietf:params:xml:ns:domain-1.0" xsi:schemaLocation="urn:ietf:params:xml:ns:domain-1.0 domain1.0.xsd">
            <domain:name>esempio1.it</domain:name>
            <domain:name>esempio2.it</domain:name>
            <domain:name>esempio3.it</domain:name>
         </domain:check>
      </check>
      <clTRID>ABC-12345</clTRID>
   </command>
</epp>
*/

class itEppCheckDomainRequest extends eppRequest
{
    function __construct($domains, $namespacesinroot = true)
    {
        parent::__construct($domains, $namespacesinroot = true);
        $this->additExtension($domains);
    }

    public function additExtension($domains)
    {
        $check = $this->createElement('check');
        $domain_check = $this->createElement('domain:check');
        $domain_check->setAttribute('xmlns:domain', 'urn:ietf:params:xml:ns:domain-1.0');
        $domain_check->setAttribute('xsi:schemaLocation', 'urn:ietf:params:xml:ns:domain-1.0 domain1.0.xsd');
        if (is_array($domains)) {
            foreach ($domains as $domainname) {
                $domain_check->appendChild($this->createElement('domain:name', $domainname));
            }
        } else {
            $domain_check->appendChild($this->createElement('domain:name', $domains));
        }
        $check->appendChild($domain_check);
        $this->getCommand()->appendChild($check);
        $this->getEpp()->setAttribute('xmlns', 'urn:ietf:params:xml:ns:epp-1.0');
        $this->getEpp()->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $this->getEpp()->setAttribute('xsi:schemaLocation', 'urn:ietf:params:xml:ns:epp-1.0 epp-1.0.xsd');
    }
}
