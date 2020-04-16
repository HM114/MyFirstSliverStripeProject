<?php


namespace App\Code;

use App\Code\Project;
use MyDataObject;
use SilverStripe\ORM\DataObject;

class Student extends DataObject
{
    private static $db = array(
       'Name' => 'Varchar',
       'University' => 'Varchar'
    );

    private static $has_one = [
        'Project' => Project::class,
//
    ];

    private static $has_many = [
            'MyDataObject' => MyDataObject::class
    ];

    private static $allowed_actions = [
        'getInfo'
    ];

    public function Link()
    {
        return $this->Project()->Link('students/'.$this->ID);
    }

    public function getInfo() {
       // echo "link". $this->getRegisterLink();
        return  $this->renderWith(array('StudentInfo','Page'));
    }

}
