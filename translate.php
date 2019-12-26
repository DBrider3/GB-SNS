<?php

    function translate($subjectStr, $dstLang){
    //$subjectStr = "안녕!";

    //echo "원본 : ".$subjectStr."\n";

  $client_id = "7MlnTH3m1UF0AP05fDcv";
  $client_secret = "TG4ZSmsT2j";
  $encQuery = urlencode($subjectStr);
  $postvars = "query=".$encQuery;
  $url = "https://openapi.naver.com/v1/papago/detectLangs";
  $is_post = true;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec ($ch);

  #print curl_error($ch);

  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  //echo "status_code:".$status_code."<br>";
  curl_close ($ch);
  $langCode = "eng";
  if($status_code == 200) {
    //echo $subjectStr." -> ".$response;
    $langCode = json_decode($response, true)["langCode"];
  } else {
    echo "Error 내용:".$response;
  }
  if($langCode == $dstLang) return $subjectStr;
  $encText = $encQuery;
  $postvars = "source=".$langCode."&target=".$dstLang."&text=".$encText;
  //echo $postvars;
  $url = "https://openapi.naver.com/v1/papago/n2mt";
  $is_post = true;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  //echo "status_code:".$status_code."<br>";
  curl_close ($ch);
  if($status_code == 200) {
    $result = json_decode($response, true)["message"]["result"]["translatedText"];
  } else {
    echo "Error 내용:".$response;
  }

  //echo "결과 : ".$result."\n";
    return $result;
    }
    
?>
