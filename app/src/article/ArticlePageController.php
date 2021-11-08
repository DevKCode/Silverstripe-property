<?php


use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;

class ArticlePageController extends PageController
{


    public function CommentForm()
    {
        return Form::create($this, __FUNCTION__, FieldList::create(
            TextField::create('Name', ''),
            EmailField::create('Email', ''),
            TextareaField::create('Comment')
        ),
            FieldList::create(FormAction::create('handleComment', 'Post Comment')),
            RequiredFields::create('Name', 'Email', 'Comment'));
    }
    private static $allowed_actions =[
        'CommentForm'
    ];
    public function CategoriesList()
    {
        if ($this->Categories()->exists()) {
            return implode(', ', $this->Categories()->column('Title'));
        }
        return null;
    }

    public function handleComment($data, $form){
        $comment = ArticleComment::create();
        $comment->Name = $data['Name'];
        $comment->Email = $data['Email'];
        $comment->Comment = $data['Comment'];
        $comment->ArticlePageID = $this->ID;
        $comment->write();

        $form->sessionMessage('Thanks for your comment','good');

        return $this->redirectBack();
    }


}
