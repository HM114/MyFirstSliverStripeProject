<?php


namespace App\Forms;


use App\DataModel\CreateUser;
use MyMemberExtension;
use PageController;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;
use function MongoDB\BSON\toJSON;

class SignupPageController extends PageController
{
    private static $allowed_actions = [
        'Register',
        'afterregistration'
    ];

    protected $extraDataObjects = [
     MyMemberExtension::class
    ];

    public function init()
    {
        parent::init();
    }

    public function Register()
    {
        $form = Form::create($this, __FUNCTION__,
            FieldList::create(
                TextField::create('FirstName', 'FirstName'),
                TextField::create('SurName', 'SurName'),
                TextField::create('Email', 'Email')
            ),
            FieldList::create(
                FormAction::create('doRegister', 'Register')
                    ->setUseButtonTag(true)
                    ->addExtraClass('btn btn-primary')
            ),
            RequiredFields::create([
                'FirstName, SurName, Email'
            ]));
        return $form;
    }

    public function doRegister($data, $form){



        if($user = CreateUser::get()->filter('Email', $data['Email'])->first()){
            $form->sessionMessage('This is already used by another user');
            return $this->redirectBack();
        }

        $newUser = CreateUser::create();
        $form->saveInto($newUser);
        $newUser->write();

        $form->sessionMessage('Thanks for registering with us!');
        return $this->redirectBack();
    }

}
