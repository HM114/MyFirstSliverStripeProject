<?php


use App\Code\Project;
use App\Code\Student;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\Connect\MySQLSchemaManager;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\Filters\GreaterThanFilter;
use SilverStripe\ORM\Filters\PartialMatchFilter;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\ORM\Search\SearchContext;

class MyDataObject extends DataObject {

    private static $db = [
        'Title' => 'Text',
        'Content' => 'Text'
    ];

    private static $create_table_options = [
        MySQLSchemaManager::ID => 'ENGINE=MyISAM'
    ];

    public function Link() {
        return $this->Students()->Link('myobjects/'.$this->ID);
        //BASE_URL.'/home/myobjects/'. $this->ID;
        //Page::get()->First()->Link() . 'myobjects/'
    }

    private static $has_one = [
        'Project' => Project::class,
        'Students' => Student::class
    ];



    /**
     * generates the fields for the SearchForm
     * @uses updateSearchFields
     * @return FieldList
     */
    public function getSearchFields()
    {
        $searchText = _t('SearchForm.SEARCH', 'Search');

        if ($this->owner->request && $this->owner->request->getVar('Search')) {
            $searchText = $this->owner->request->getVar('Search');
        }

        $fields = new FieldList(
            new TextField('Search', false, $searchText)
        );

        $this->owner->extend('updateSearchFields', $fields);

        return $fields;
    }


    public function getCustomSearchContext()
    {
        $fields = $this->scaffoldSearchFields([
            'restrictFields' => ['Title','Content']
        ]);

        $filters = [
            'Title' => new PartialMatchFilter('Title'),
            'Content' => new GreaterThanFilter('Content')
        ];

        return new SearchContext(
            MyDataObject::class,
            $fields,
            $filters
        );
    }


}
