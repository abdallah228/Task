<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * This Function will return count of numbers in params
     * @param $number1
     * @param $number2
     * @return json
     */
    public function calc($number1,$number2 ,Request $request) {
        // dd(mb_substr($number1,0,1));
        if($number1 < $number2) {
        $countable = [];
        for($i = $number1 ; $i <= $number2 ; $i++) {
                //mb_substr to find last index as string
                if(mb_substr($i,-1) != 5 && mb_substr($i,0,1) != 5 ) {
                    echo $i;
                array_push($countable,$i);
                }
    }
        return response()->json(['count'=>count($countable)]);
    }
    else {
        return response()->json(['OOps number2 Shoud be > number 1']);
    }

    }
/**
 * This function will return no of index to alphapet
 * @param $letter
 * @return integer
 */
    public function letter($letter) {
        return response()->json(['count of number is '=> $this->getColNo($letter) ]);
    }

    public function getColNo($colLetters){
        $colLetters = strtoupper($colLetters);
        $strlen = strlen($colLetters);
        preg_match("/^[A-Z]+$/",$colLetters,$matches);
        if(!$matches) {
            return "Invalid characters!";
        }
        $it = 0; $vals = 0;
        for($i=$strlen-1;$i>-1;$i--){
          $vals += (ord($colLetters[$i]) - 64 ) * pow(26,$it);
          $it++;
        }
        return $vals; //this is the answer
    }


}
