<?php


use SilverStripe\Admin\ModelAdmin;


class MyObjectAdmin extends ModelAdmin
{
    private static $url_segment = 'myobjectadmin';

    private static $menu_title = 'My Object';

    private static $managed_models = [
        MyDataObject::class,
    ];
}
