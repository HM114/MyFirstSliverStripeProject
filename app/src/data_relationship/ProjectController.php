<?php


namespace App\Code;


use ArrayObject;
use MyDataObject;
use PageController;
use PhpParser\Node\Expr\List_;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\Map;
use SilverStripe\Security\Security;
use SilverStripe\View\ArrayData;


class ProjectController extends PageController
{
    private static $allowed_actions = [
        'myobjects',
        'students_s'
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
                    //'Name'=> Security::getCurrentUser()->FirstName
                ];

            } else {
                //Not found
                return $this->httpError(404, 'Not found');
            }
        }
    }

    public function students_s(HTTPRequest $request)
    {
        // echo $request->param('ID');
        //if ($ID = $request->param('ID')) {

            $Object = Student::get();

            if ($Object) {



//                $map = new Map($Object, 'Title','ProjectID');
//                $mentors = ArrayList::create();
//                foreach ($map as $projectId){
//                    $project = Project::get();
//                    $mentors->add($project->Mentors());
//                   // $single_mentors = new Map($mentors,'ID', 'Name');
//                    //echo $projectId;
//
//                }

                $project = Project::get();
               // var_dump($project->count());
                return [
                    'Student' => $Object,
                    'Project'=> $project
                    //'Name'=> Security::getCurrentUser()->FirstName
                ];
                //var_dump($allmentors->values());



            } else {
                //Not found
                return $this->httpError(404, 'Not found');
            }
       // }
    }
}
