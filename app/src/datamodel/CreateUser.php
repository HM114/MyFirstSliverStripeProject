<?php


namespace App\DataModel;


use SilverStripe\ORM\DataObject;

class CreateUser extends DataObject
{
    private static $table_name = 'Gecco_Users';

    private static $db = [
        'FirstName' => 'Varchar(50)',
        'SurName' => 'Varchar(50)',
        'Email' => 'Text'
    ];

    public function getFullName(){
        return $this->FirstName.' '.$this->SurName;
    }


}
