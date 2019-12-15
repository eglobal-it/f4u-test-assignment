<?php
class ClientAddressTest extends TestCase
{
    /**
     * /clients [GET]
     */
    public function testShouldReturnAllClientAddress(){
        $this->get("client_addresses", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            '*' =>
                [
                    'client_id',
                    'street',
                    'zipcode',
                    'city',
                    'country',
                    'is_default',
                    'created_at',
                    'updated_at'
                ]
            
            
        ]);
        
    }
    /**
     * /clients/id [GET]
     */
    public function testShouldReturnClientAddress(){
        $this->get("client_addresses/2", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                    'client_id',
                    'street',
                    'zipcode',
                    'city',
                    'country',
                    'is_default',
                    'created_at',
                    'updated_at'
                ]
            ]    
        );
        
    }
    /**
     * /client_addresses [POST]
     */
    public function testShouldCreateClientAddress(){
        $parameters = [
            'client_id' => 5,
            'street' => 'St. Patrick School',
            'zipcode' => '232134',
            'city' => 'Singapore',
            'country' => 'Singapore',
            'is_default' => 0,        ];
        $this->post("client_addresses", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            
                [
                    'client_id',
                    'street',
                    'zipcode',
                    'city',
                    'country',
                    'is_default',
                    'created_at',
                    'updated_at'
                ]
            
        );
        
    }
    
    /**
     * /client_addresses/id [PUT]
     */
    public function testShouldUpdateClientAddress(){
        $parameters = [
            'street' => 'Spark Tots School',
            'zipcode' => '546453',
            'city' => 'Singapore',
            'country' => 'Singapore',
        ];
        $this->put("client_addresses/5", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                    'client_id',
                    'street',
                    'zipcode',
                    'city',
                    'country',
                    'is_default',
                    'created_at',
                    'updated_at'
                ]
            ]    
        );
    }
    /**
     * /client_addresses/id [DELETE]
     */
    public function testShouldDeleteClientAddress(){
        
        $this->delete("client_addresses/5", [], []);
        $this->seeStatusCode(410);
        $this->seeJsonStructure([
                'status',
                'message'
        ]);
    }
}