<?php

namespace GuayaquilLib;

use SoapClient;
use SoapFault;

class GuayaquilSoapWrapper
{
    private $userLogin;
    private $userSecretKey;
    private $oemServiceUrl = 'ws.laximo.ru';
    private $amServiceUrl = 'aws.laximo.ru';

    /**
     * @param string $login
     * @param string $key
     */
    public function setUser(string $login, string $key)
    {
        $this->userLogin = $login;
        $this->userSecretKey = $key;
    }

    /**
     * @param string $oemServiceUrl
     */
    public function setOemServiceUrl(string $oemServiceUrl)
    {
        $this->oemServiceUrl = $oemServiceUrl;
    }

    /**
     * @param string $amServiceUrl
     */
    public function setAmServiceUrl(string $amServiceUrl)
    {
        $this->amServiceUrl = $amServiceUrl;
    }

    /**
     * @param string $request
     * @param bool $laximoOem
     * @return mixed
     * @throws SoapFault
     */
    public function queryData(string $request, string $service)
    {
        $client = $this->getSoapClient($service);

        return $client->QueryDataLogin($request, $this->userLogin, md5($request . $this->userSecretKey));
    }

    /**
     * @param bool $laximoOem
     * @return SoapClient
     * @throws SoapFault
     */
    protected function getSoapClient(string $service): SoapClient
    {
        $options = [
            'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
            'uri' => $service == 'oem' ? 'http://WebCatalog.Kito.ec' : 'http://Aftermarket.Kito.ec',
            'location' => $service == 'oem' ? 'http://' . $this->oemServiceUrl . '/ec.Kito.WebCatalog/services/Catalog.CatalogHttpSoap11Endpoint/' :
                'http://' . $this->amServiceUrl . '/ec.Kito.Aftermarket/services/Catalog.CatalogHttpSoap11Endpoint/',
        ];

        return new SoapClient(null, $options);
    }
}
