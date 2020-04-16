<?php


namespace App\Code;


use PageController;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Security\Security;

class StudentController extends PageController
{
//'MyDataObject' => MyDataObject::class

    private static $allowed_actions = [
        'Link'
    ];

}
