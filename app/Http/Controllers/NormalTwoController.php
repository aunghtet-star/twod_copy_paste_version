<?php

namespace App\Http\Controllers;

use App\Models\NormalTwo;
use Illuminate\Http\Request;
use MyanLottery\Lottery\Twod;

class NormalTwoController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function normalTwo(Request $request){


        foreach ($request->all() as $two){

            $first_word = str_split($two,1)[0];

            $first_three_word = str_split($two,3)[0];
            $dash = substr($first_three_word,2);

            $first_two_word = str_split($two,2)[0];
            $htate = substr($first_two_word,1);

            $newTwo = new Twod();


            if ($dash === ' '){
                $multi_word = explode(" ",$two);

                $last_word = end($multi_word);

                $multi_first_word = str_split($last_word,3)[0];
                $multi_dash = substr($multi_first_word,2);

                if ($multi_dash === '.'){
                    $last_amount = explode('.',$last_word);

                    foreach ($multi_word as $word){
                        $response[] = [$word,$last_amount[1]];
                    }

                    $last_response = end($response);
                    $response[] = explode('.',$last_response[0]);


                    unset($response[count($response)-2]);

                }

                if ($multi_dash === 'r'){
                    $last_amount = explode('r',$last_word);

                    foreach ($multi_word as $word){
                        $response[] = [$word,$last_amount[1]];
                        $response[] = [strrev($word),$last_amount[1]];
                    }

                    $last_response = end($response);

                    $last_r_number = explode('r',$last_response[0]);
                    $last_prev_r_number = explode('r',$response[count($response)-2][0]);

                    $response[] = [$last_r_number[1],$last_amount[1]];
                    $response[] = [$last_prev_r_number[0],$last_amount[1]];


                    unset($response[count($response)-3]);
                    unset($response[count($response)-3]);

                }


            }


            if ($dash === '.'){
                $response[] =  explode('.',$two);
            }

            if ($dash === 'r'){
                $r_two = explode('r',$two);

                $response[] = $r_two;
                $response[] = [strrev($r_two[0]),$r_two[1]];
            }

//            if ($dash === 'r'){
//                $r_two = explode('r',$two);
//
//                $response[] = [$r_two[0],$r_two[1]/2 ];
//                $response[] = [strrev($r_two[0]),$r_two[1]/2];
//            }

            if($htate === 't'){
                //$h = htatesee
                $t = explode('t',$two);
                foreach ($newTwo->htatesee($two[0])->getData()->data as $data){
                    $response[] = [$data,$t[1]];
                }
            }

            if($htate === 'n'){
                //$n = naukpate
                $n = explode('n',$two);
                foreach ($newTwo->naukpate($two[0])->getData()->data as $data){
                    $response[] = [$data,$n[1]];
                }
            }

            if($htate === 'a'){
                //$a = a par (1 apr,2 apr,etc)
                $a = explode('a',$two);
                foreach ($newTwo->oneround($two[0])->getData()->data as $data){
                    $response[] = [$data,$a[1]];
                }
            }

            if($htate === 'b'){
                //$b = brake (1 brake,2 brake,etc)
                $b = explode('B',$two);
                foreach ($newTwo->break_round($two[0])->getData()->data as $data){
                    $response[] = [$data,$b[1]];
                }
            }

            if($first_word === 'p'){
                //$p = a puu (1 puu,2 puu,etc)
                $p = explode('p',$two);
                foreach ($newTwo->apuu()->getData()->data as $data){
                    $response[] = [$data,$p[1]];
                }
            }

            if($first_word === 'N'){
                //$N = nat khat ()
                $p = explode('N',$two);
                foreach ($newTwo->natkhat()->getData()->data as $data){
                    $response[] = [$data,$p[1]];
                }
            }

            if($first_word === 'w'){
                //$w = Power ()
                $w = explode('w',$two);
                foreach ($newTwo->power()->getData()->data as $data){
                    $response[] = [$data,$w[1]];
                }
            }

            if($first_word === 'k'){
                //$w = nyiko ()
                $k = explode('k',$two);
                foreach ($newTwo->nyiko()->getData()->data as $data){
                    $response[] = [$data,$k[1]];
                }
            }




        }

        foreach ($response as $two){
            NormalTwo::create([
                'two' => $two[0],
                'amount' => $two[1],
                'date' => now()->format('Y-m-d')
            ]);
        }

        return response()->json([
            'response' => 'success'
        ],200);
    }
}
