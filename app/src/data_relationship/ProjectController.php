<?php


namespace App\Code;


use MyDataObject;
use PageController;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Security;

class ProjectController extends PageController
{
    private static $allowed_actions = [
        'myobjects',
        'students'
    ];

    public function myobjects(HTTPRequest $request)
    {
       // echo $request->param('ID');
        if ($ID = $request->param('ID')) {
            $Object = MyDataObject::get()->byID( $ID);
          //  var_dump($Object);
            if ($Object) {

                return [
                    'MyObject' => $Object,
                    'Name'=> Security::getCurrentUser()->FirstName
                ];

            } else {
                //Not found
                return $this->httpError(404, 'Not found');
            }
        }
    }

    public function students(HTTPRequest $request)
    {
        // echo $request->param('ID');
        if ($ID = $request->param('ID')) {
            $Object = Student::get()->byID( $ID);
            //  var_dump($Object);
            if ($Object) {

                return [
                    'Student' => $Object,
                    'Name'=> Security::getCurrentUser()->FirstName
                ];

            } else {
                //Not found
                return $this->httpError(404, 'Not found');
            }
        }
    }
}
