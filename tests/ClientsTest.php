<?php

class ClientsTest extends TestCase
{

    /**
     * /clients [GET]
     */
    public function testShouldReturnAllClients(){
        $this->get("clients", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
         '*' =>
                [
                    'id',
                    'firstname',
                    'lastname',
                    'created_at',
                    'updated_at'
                ]
            
        ]
        );
        
    }
    /**
     * /clients/id [GET]
     */
    public function testShouldReturnClient(){
        $this->get("clients/4444", []);
        $this->seeStatusCode(422);
        $this->seeJsonStructure(
             [
                    'id' => 
                        "The id field is required."
                    
                    
            ]
               
        );
        
    }
}