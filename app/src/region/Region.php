<?php


use Intervention\Image\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Versioned\Versioned;

class Region extends DataObject
{

    private static $db = [
        'Title' => 'Varchar',
        'Description' => 'Text'
    ];

    private static $has_one = [
        'RegionsPage' => RegionsPage::class
    ];
//    private static $summary_fields = [
//        'GridThumbnail' => '',
//        'Title' => 'Title',
//        'Description' => 'Description'
//    ];

    private static $has_many =[
        'Properties' => Property::class
    ];

    public function getCMSFields()
    {
        $fields = FieldList::create(
            TextField::create('Title'),
            TextareaField::create('Description')

        );

        return $fields;
    }

    public function Link(){
        return $this->RegionsPage()->Link('show/'.$this->ID);
    }
}
