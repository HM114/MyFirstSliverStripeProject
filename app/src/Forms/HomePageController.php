<?php

namespace App\Forms;


use MyDataObject;
use PageController;
use SilverStripe\CMS\Search\SearchForm;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;



class HomePageController extends PageController
{
    public function getRegisterLink() {
        $registerPage = SignupPage::get()->first();
        if ($registerPage) {
            return $registerPage->AbsoluteLink();
        }
    }

    private static $allowed_actions =[
        'SearchForm'
    ];

    public function SearchForm()
    {
        $context = singleton(MyDataObject::class)->getCustomSearchContext();
        $fields = $context->getSearchFields();

        $form =  SearchForm::create($this, __FUNCTION__,
            $fields,
            FieldList::create(
                FormAction::create('doSearch')
            )
        );

        return $form;

    }

    public function doSearch($data, $form)
    {
        $context = singleton(MyDataObject::class)->getCustomSearchContext();
        $results = $context->getResults($data);

        return $this->customise([
            'Results' => $results
        ])->renderWith('Page_results');
    }


}

