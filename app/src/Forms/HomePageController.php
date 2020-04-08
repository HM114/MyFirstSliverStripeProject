<?php

namespace App\Forms;


use MyDataObject;
use PageController;
use SilverStripe\CMS\Search\SearchForm;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\ORM\PaginatedList;


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
        echo "searchform";

        return $form;

    }

    public function doSearch($data, $form)
    {
        $context = singleton(MyDataObject::class)->getCustomSearchContext();
        $results = $this->getResults($data);
        var_dump($data);
        die;
        return $this->customise([
            'Results' => $results
        ])->renderWith('Page_results');
    }

    public function getResults($searchCriteria = [])
    {
        $start = ($this->getRequest()->getVar('start')) ? (int)$this->getRequest()->getVar('start') : 0;
        $limit = 10;
        echo 1;
        $context = singleton(MyDataObject::class)->getCustomSearchContext();
        echo 2;
        $query = $context->getQuery($searchCriteria, null, ['start'=>$start,'limit'=>$limit]);
        echo 3;
        $records = $context->getResults($searchCriteria, null, ['start'=>$start,'limit'=>$limit]);
        echo 4;

        if($records) {
            $records = new PaginatedList($records, $this->getRequest());
            $records->setPageStart($start);
            $records->setPageLength($limit);
            $records->setTotalItems($query->unlimitedRowCount());
        }

        return $records;
    }
}

