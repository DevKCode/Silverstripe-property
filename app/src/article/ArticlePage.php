<?php


use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;

class ArticlePage extends Page
{
    private static $can_be_root = false;

    private static $db = [
        'Date' => 'Date',
        'Teaser' => 'Text',
        'Author' => 'Varchar'
    ];

    private static $has_one = [
        'Photo' => Image::class,
        'Brochure' => File::class
    ];

    private static $has_many = [
        'Comments' => ArticleComment::class
    ];

    private static $many_many = [
        'Categories' => ArticleCategory::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', DateField::create('Date', 'Date of article'), 'Content');
        $fields->addFieldToTab('Root.Main', TextareaField::create('Teaser'), 'Content');
        $fields->addFieldToTab('Root.Main', TextField::create('Author', 'Author of article'), 'Content');
        $fields->addFieldToTab('Root.Attachments', UploadField::create('Photo'));
        $fields->addFieldToTab('Root.Attachments', UploadField::create('Brochure', ' Travel brochure (PDF only)'));

        $fields->addFieldToTab('Root.Categories', CheckboxSetField::create(
            'Categories', 'Selected Categories', $this->Parent()->Categories()->map('ID', 'Title')
        ));
        return $fields;
    }

    public function CategoriesList()
    {
        if ($this->Categories()->exists()) {
            return implode(', ', $this->Categories()->column('Title'));
        }
        return null;
    }


}
