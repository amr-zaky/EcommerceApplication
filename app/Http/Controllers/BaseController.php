<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class BaseController extends Controller
{
    public $defaultLimit = 30;

    public function getOffset()
    {
        if (request()->offset > 0) {
            $offset = (int)request()->offset;
        } else {
            $offset = 0;
        }

        return $offset;
    }

    public function getLimit()
    {
        if (request()->limit > 0) {
            $limit = request()->limit;
        } else {
            $limit = $this->defaultLimit;
        }

        return $limit;
    }

    public function nextOffset()
    {
        return (int)$this->getOffset() + $this->getLimit();
    }

}
