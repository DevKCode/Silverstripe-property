<?php


class HomePageController extends PageController
{

    public function LatestArticles()
    {
        return ArticlePage::get()->sort('ID', 'DESC')->limit(3);
    }

    public function FeaturedProperties()
    {
        return Property::get()->filter([
            'FeaturedOnHomepage' => true
        ])->limit(6);
    }
}
