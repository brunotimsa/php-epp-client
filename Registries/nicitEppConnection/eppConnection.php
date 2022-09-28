<?php

namespace Metaregistrar\EPP;

class nicitEppConnection extends eppHttpsConnection
{

    public function __construct($logging = false, $settingsfile = null)
    {
        parent::__construct($logging, $settingsfile);

        parent::setServices(array(
            'urn:ietf:params:xml:ns:domain-1.0' => 'domain',
            'urn:ietf:params:xml:ns:contact-1.0' => 'contact'
        ));

        parent::useExtension('it-extepp-2.0');
        parent::useExtension('it-extcon-1.0');
        parent::useExtension('it-extdom-2.0');
        parent::useExtension('it-rgp-1.0');
    }
}
