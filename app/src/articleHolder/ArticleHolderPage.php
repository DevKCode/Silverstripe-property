<?php

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class ArticleHolderPage extends Page
{
    private static $allowed_children = [
        ArticlePage::class
    ];

    private static $has_many =[
        'Categories' => ArticleCategory::class
    ];

    public function getCMSFields()
    {
       $fields =  parent::getCMSFields();
       $fields->addFieldToTab('Root.Categories', GridField::create(
           'Categories',
           'Article categorie',
           $this->Categories(),
           GridFieldConfig_RecordEditor::create()
       ));
       return $fields;
    }
}
