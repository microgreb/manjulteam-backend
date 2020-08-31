<?php

    namespace App\Repositories;

    use NovaPoshta\ApiModels\Address;
    Use NovaPoshta\Config;
    use NovaPoshta\MethodParameters\Address_getCities;
    use NovaPoshta\MethodParameters\Address_getWarehouses;

    /**
     * Class NPDeliveryRepository
     *
     * @package App\Repositories
     */
    class NPDeliveryRepository
    {

        protected $np_address;

        /**
         * NPDeliveryRepository constructor.
         */
        public function __construct()
        {
            Config::setApiKey(env('NP_API_KEY'));
            Config::setFormat(Config::FORMAT_JSONRPC2);
            Config::setLanguage(Config::LANGUAGE_RU);

            $this->np_address = new Address();
        }

        /**
         * @return mixed
         */
        public function getAreas()
        {
            return [
                'data' => [
                    ['name' => 'Винницкая'],
                    ['name' => 'Волынская'],
                    ['name' => 'Днепропетровская'],
                    ['name' => 'Донецкая'],
                    ['name' => 'Житомирская'],
                    ['name' => 'Закарпатская'],
                    ['name' => 'Запорожская'],
                    ['name' => 'Ивано-Франковская'],
                    ['name' => 'Киевская'],
                    ['name' => 'Кировоградская'],
                    ['name' => 'Луганская'],
                    ['name' => 'Львовская'],
                    ['name' => 'Николаевская'],
                    ['name' => 'Одесская'],
                    ['name' => 'Полтавская'],
                    ['name' => 'Ровненская'],
                    ['name' => 'Сумская'],
                    ['name' => 'Тернопольская'],
                    ['name' => 'Харьковская'],
                    ['name' => 'Херсонская'],
                    ['name' => 'Хмельницкая'],
                    ['name' => 'Черкасская'],
                    ['name' => 'Черниговская'],
                    ['name' => 'Черновицкая'],
                ]
            ];
        }

        /**
         * @param $cityQuery
         * @param string $areaQuery
         * @return mixed
         */
        public function getCities(string $areaQuery, $cityQuery = '')
        {
            $data = new Address_getCities();
            $data->setFindByString($cityQuery);

            return (((array)Address::getCities($data))['data'] ?? []);
        }

        /**
         * @param $city
         * @return mixed
         */
        public function getWarehouses(string $city_ref)
        {
            $data = new Address_getWarehouses();
            $data->setCityRef($city_ref);
            $result =  (((array)Address::getWarehouses($data))['data'] ?? []);

            return $result;
        }

        private function np_response($response)
        {
            return $response['data'] ? collect($response['data']) : [];
        }
    }
