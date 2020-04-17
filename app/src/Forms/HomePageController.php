<?php

namespace App\Forms;



use Couchbase\MatchSearchQuery;
use MyDataObject;
use Page;
use PageController;
use SilverStripe\CMS\Search\SearchForm;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Convert;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\DB;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\ORM\Queries\SQLSelect;


class HomePageController extends PageController
{
    public function getRegisterLink() {
        $registerPage = SignupPage::get()->first();
        if ($registerPage) {
            return $registerPage->AbsoluteLink();
        }
    }

    private static $allowed_actions =[
        'SearchForm',
        'myobjects'
    ];




    public function SearchForm()
    {
        $context = singleton(MyDataObject::class)->getDefaultSearchContext();
        $fields = singleton(MyDataObject::class)->getSearchFields();

        $form =  SearchForm::create($this, __FUNCTION__,
            $fields,
            FieldList::create(
                FormAction::create('results')
            )
        );
        //echo "searchform";

        return $form;

    }

    public function results($data, $form)
    {
       // $context = singleton(MyDataObject::class)->getCustomSearchContext();

        $results = $this->getResults($data);
        //var_dump($results);
        return $this->customise([
            'Results' => $results
        ])->renderWith(array('Page_results','Page'));
    }

    public function getResults($searchCriteria = [])
    {
//        $start = ($this->getRequest()->getVar('start')) ? (int)$this->getRequest()->getVar('start') : 0;
//        $limit = 10;
//
//        $context = singleton(MyDataObject::class)->getCustomSearchContext();
//        var_dump($searchCriteria);
//        $query = $context->getQuery($searchCriteria, null, ['start'=>$start,'limit'=>$limit]);
//        $records = $context->getResults($searchCriteria, null, ['start'=>$start,'limit'=>$limit]);
//
//       // var_dump($records);
//
//        if($records) {
//            try {
//                $records = new PaginatedList($records, $this->getRequest());
//            } catch (\Exception $e) {
//            }
//            $records->setPageStart($start);
//            $records->setPageLength($limit);
//            //$records->setTotalItems($query->unlimitedRowCount());
//        }



        $conn = DB::get_conn();
        $list = new ArrayList();

        //$q = (isset($searchCriteria['Search'])) ? $searchCriteria['Search'] : $request->getVar('Search');

        $input = Convert::raw2sql($searchCriteria['Search']);
       // echo $input;
        $query = "SELECT * FROM \"mydataobject\" WHERE MATCH (\"Title\", \"Content\") AGAINST ('$input' IN BOOLEAN MODE) ";

        $results = DB::query($query);

       /* echo "Simple SQL query";
        $where = "MATCH (Title, Content) AGAINST ('$input' IN BOOLEAN MODE)";
        $orm_query = SQLSelect::create()
            ->setFrom('mydataobject')
            ->setWhere($where)
            ->toSelect();
        $orm_query->execute();

        var_dump($results);*/

        foreach ($results as $row) {
            $do = DataObject::get_by_id($row['ClassName'], $row['ID']);
            if (is_object($do) && $do->exists()) {

                //$students = $do->Students();
               // var_dump($do);
                $list->push(['Title'=> $row['Title'],
                    'Content'=> $row['Content'],
                    'Link'=>$do->Link($row['Title'])]);

            }

        }

        $pageLength = Config::inst()->get(HomePageController::class, 'items_per_page');
        $ret = new PaginatedList($list);
       // var_dump($list);
        $ret->setPageLength($pageLength);

        return $ret;
    }
}

