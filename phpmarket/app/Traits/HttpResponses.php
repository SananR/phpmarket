<?php

namespace App\Traits;

trait HttpResponses {

    protected function notFoundError() {
        return response('{"message":"Record not found."}', 404,['Content-Type'=>'application/json']);
    }
    protected function authError() {
        return response('{"error":"Requires Authorization"}', 403, ['Content-Type'=>'application/json']);
    }

}
