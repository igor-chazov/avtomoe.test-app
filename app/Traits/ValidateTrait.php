<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

trait ValidateTrait
{
    public function validate($inputs) {
        $validator = Validator::make($inputs, $this->rules);

        if($validator->passes()) {
            return true;
        }

        $this->errors = $validator->messages();

        return false;
    }
}
