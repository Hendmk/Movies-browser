<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Redirect;



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Start(){
      $title = "browse Movie";
      if(session('session_id') == ""){
      return $this->RequestToken();
    }
    if(session('listID') == ""){
      $list =  $this->CreatList();
    }else{
      return view ('Start browse Movie',  compact('title') );}
      //return session('session_id');
    } //End start function

    public function CreatList(){
      $url = "https://api.themoviedb.org/3/list?session_id=".session('session_id')."&api_key=ac94d05fd0688fbb7d721732d6e86321";
      $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"name\":\"This is my awesome test list.\",\"description\":\"Just an awesome list dawg.\",\"language\":\"en\"}",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/json;charset=utf-8"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $FavoritesUrl = "https://api.themoviedb.org/3/account/%7Baccount_id%7D/favorite/movies?sort_by=created_at.asc&language=en-US&session_id=".session('session_id')."&api_key=ac94d05fd0688fbb7d721732d6e86321";
  $FavoritesData = $this->connectAPI($FavoritesUrl);
  return $this->AddfaivMoviesToList($response, $FavoritesData);
}
}//End CreatList function

    public function AddfaivMoviesToList($List, $MovieList){
      $data = json_decode($List, true);
      session(['listID'=> $data['list_id'] ]);

      $Movies = json_decode($MovieList, true);
        $i=0;
      foreach ($Movies['results'] as $Movie => $value) {
        $mediaIDs[$i]= $value['id'];
        $i++;
      }
      $url = "https://api.themoviedb.org/3/list/".session('listID')."/add_item?session_id=".session('session_id')."&api_key=ac94d05fd0688fbb7d721732d6e86321";
      $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"media_id\":".implode(' ',$mediaIDs)."}",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/json;charset=utf-8"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  return $this->start();
}
}//End AddfaivMoviesToList function


    public function connectAPI($url){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{}",
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        //echo $response;
      return $response;
    }
  }//End connectAPI function


    public function getMovie(){
      $url = "https://api.themoviedb.org/3/movie/now_playing?language=en-US&api_key=ac94d05fd0688fbb7d721732d6e86321";
    return $this->connectAPI($url);
  } // end get movies function

  public function SearchMovie($str){
    $url = "https://api.themoviedb.org/3/search/movie?include_adult=false&query=".$str."&language=en-US&api_key=ac94d05fd0688fbb7d721732d6e86321";
    return $this->connectAPI($url);
   }//End search function

   public function MovieDetails($id){
     $title = "Movie Details";
     return view ('Movie Details',  compact('title', 'id') );

   }//End MovieDetails function


   public function RetriveMovieDetails($id){
     $url = "https://api.themoviedb.org/3/movie/".$id."?api_key=ac94d05fd0688fbb7d721732d6e86321&language=en-US";
     return $this->connectAPI($url);
   } // End RetriveMovieDetails function


   public function RetriveMovieCast($id){
     $url = "https://api.themoviedb.org/3/movie/".$id."/credits?api_key=ac94d05fd0688fbb7d721732d6e86321";
     return $this->connectAPI($url);
   }//End RetriveMovieCast function

   public function RetriveSimilarMovies($id){
     $url = "https://api.themoviedb.org/3/movie/".$id."/similar?language=en-US&api_key=ac94d05fd0688fbb7d721732d6e86321";
     return $this->connectAPI($url);
   }//End RetriveSimilarMovies function


   public function RetriveCastDetails($id){
     $title = "Cast Details";
     return view ('Cast Details',  compact('title', 'id') );
   }

   public function CastDetails($id){
     $url = "https://api.themoviedb.org/3/person/".$id."?language=en-US&api_key=ac94d05fd0688fbb7d721732d6e86321";
     return $this->connectAPI($url);
    }// End CastDetails function

    public function MovieCastIn($id){
      $url = "https://api.themoviedb.org/3/person/".$id."/movie_credits?language=en-US&api_key=ac94d05fd0688fbb7d721732d6e86321";
      return $this->connectAPI($url);
} //End MovieCastIn function


    public function RequestToken(){
      $url = "https://api.themoviedb.org/3/authentication/token/new?api_key=ac94d05fd0688fbb7d721732d6e86321";
      $data = json_decode($this->connectAPI($url), true);
    session(['request_token'=> $data['request_token'] ]);
 $url = "https://www.themoviedb.org/authenticate/".$data['request_token']."?redirect_to=http://127.0.0.1:8000/sessionID";
  return Redirect::to($url);

    /*
    {
  "success": true,
  "expires_at": "2018-03-07 18:43:05 UTC",
  "request_token": "d134b7c33c9559f3f4873d03f005700a368252a5"
}
*/

    }

    public function sessionID(){
      // Retrieve a piece of data from the session...
      $Token = session('request_token');
      $url = "https://api.themoviedb.org/3/authentication/session/new?request_token=".$Token."&api_key=ac94d05fd0688fbb7d721732d6e86321";
      $data = json_decode($this->connectAPI($url), true);
      // Store a piece of data in the session...
      session(['session_id' => $data['session_id'] ]);
      //return $this->start();
      return session('session_id');
    }//End sessionID function


    public function checkIsfavorite($MovieID){
      $url = "https://api.themoviedb.org/3/list/".session('listID')."/item_status?movie_id=".$MovieID."&api_key=ac94d05fd0688fbb7d721732d6e86321";
      return $this->connectAPI($url);
    }//End checkIsfavorite function

    public function Addfavorite($MovieID){

    }//End Addfavorite function





}
