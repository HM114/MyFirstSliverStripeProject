<?php


namespace App\Code;

use App\Code\Project;
use SilverStripe\ORM\DataObject;

class Student extends DataObject
{
    private static $db = array(
       'Name' => 'Varchar',
       'University' => 'Varchar'
    );

    private static $has_one = [
        'Project' => Project::class
    ];

    function getInfo() {
        return $this->renderWith('StudentInfo');
    }

}
