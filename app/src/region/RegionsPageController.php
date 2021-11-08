<?php


use SilverStripe\Control\HTTPRequest as HTTPRequestAlias;

class RegionsPageController extends PageController
{
    private static $allowed_actions = [
        'show'
    ];

    public function show(HTTPRequestAlias $request)
    {
        $region = Region::get()->byID($request->param('ID'));
        if (!$region) {
            return $this->httpError(404, 'This region could not be found');
        }
        return ['Region' => $region];
    }
}
