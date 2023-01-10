<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ValidatorEngine extends Controller
{
    public static function  validatePayload($data)
    {
        $main_errors = array();

        try {
            foreach ($data as $key => $value) {
                $rules = explode("|", $value["rules"]);
                $errors = array();
                foreach ($rules as $rule) {
                    switch ($rule) {
                        case "alpha":
                            !self::isAlpha($value['value']) ? array_push($errors, "Must be alpha") : "";
                            break;
                        case "required":
                            !self::isRequired($value['value']) ? array_push($errors, "Is Required") : "";
                            break;
                        case "email":
                            !self::isEmail($value['value']) ? array_push($errors, "Must be email") : "";
                            break;
                        case "number":
                            !self::isNumber($value['value']) ? array_push($errors, "Must be a number") : "";
                            break;
                        default:
                            break;
                    }
                }
                if (count($errors) > 0) {
                    $main_errors[$key] = $errors;
                }
            }
        } catch (\Throwable $th) {
           
            $main_errors["input"] = "Invalid input";
        }
        finally{
            if (count($main_errors) > 0) {
            throw ValidationException::withMessages($main_errors);
        } else {
            return response()->json(["status" => "success"], 200);
        }
        }

        
    }

    protected static function isAlpha($data)
    {
        return ctype_alpha($data);
    }

    protected static function isRequired($data)
    {
        return strlen($data) > 0;
    }

    protected static function isEmail($data)
    {
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }

    protected static function isNumber($data)
    {
        return ctype_digit($data);
    }
}
