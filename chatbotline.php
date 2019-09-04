<?php 
	/*Get Data From POST Http Request*/
	$datas = file_get_contents('php://input');
	/*Decode Json From LINE Data Body*/
	$deCode = json_decode($datas,true);
	file_put_contents('A/log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);
	$replyToken = $deCode['events'][0]['replyToken'];
	$messages = [];
	$messages['replyToken'] = $replyToken;
	$encodeJson = json_encode($messages);
	$LINEDatas['url'] = "https://api.line.me/v2/bot/message/reply";
  	$LINEDatas['token'] = "mDPBPcQ0Fr6GCiX32OuP6DwxSUh5EqJApro32CVUiOq5POInzlN+JKU+Kzp9+VxgFOhAO71muZmg80gP2Lz1mPVu8z5B8gY+txex9uRFD1Un/oWQMNAddAx+eYjUIoIdB7+vdhzBcQkkW+UfkvXJTwdB04t89/1O/w1cDnyilFU=";
  	$results = sentMessage($encodeJson,$LINEDatas);
	
	  $message = $arrayJson['events'][0]['message']['text'];
	  #ตัวอย่าง Message Type "Text"
		  if($message == "สวัสดี"){
			  $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
			  $arrayPostData['messages'][0]['type'] = "text";
			  $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
			  replyMsg($arrayHeader,$arrayPostData);
		  }
		  #ตัวอย่าง Message Type "Sticker"
		  else if($message == "ฝันดี"){
			  $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
			  $arrayPostData['messages'][0]['type'] = "sticker";
			  $arrayPostData['messages'][0]['packageId'] = "2";
			  $arrayPostData['messages'][0]['stickerId'] = "46";
			  replyMsg($arrayHeader,$arrayPostData);
		  }
		  #ตัวอย่าง Message Type "Image"
		  else if($message == "รูป" , "$id"){
			  $id= $_REQUEST['id'];
			  $image_url = 'http://vpn.idms.pw:9977/polis/imagebyte?id='.$id;
			  $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
			  $arrayPostData['messages'][0]['type'] = "image";
			  $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
			  $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
			  replyMsg($arrayHeader,$arrayPostData);
		  }
		  #ตัวอย่าง Message Type "Location"
		  else if($message == "พิกัดสยามพารากอน"){
			  $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
			  $arrayPostData['messages'][0]['type'] = "location";
			  $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
			  $arrayPostData['messages'][0]['address'] =   "13.7465354,100.532752";
			  $arrayPostData['messages'][0]['latitude'] = "13.7465354";
			  $arrayPostData['messages'][0]['longitude'] = "100.532752";
			  replyMsg($arrayHeader,$arrayPostData);
		  }
		  #ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
		  else if($message == "ลาก่อน"){
			  $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
			  $arrayPostData['messages'][0]['type'] = "text";
			  $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
			  $arrayPostData['messages'][1]['type'] = "sticker";
			  $arrayPostData['messages'][1]['packageId'] = "1";
			  $arrayPostData['messages'][1]['stickerId'] = "131";
			  replyMsg($arrayHeader,$arrayPostData);
		  }
	  function replyMsg($arrayHeader,$arrayPostData){
			  $strUrl = "https://api.line.me/v2/bot/message/reply";
			  $ch = curl_init();
			  curl_setopt($ch, CURLOPT_URL,$strUrl);
			  curl_setopt($ch, CURLOPT_HEADER, false);
			  curl_setopt($ch, CURLOPT_POST, true);
			  curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
			  curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
			  curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
			  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			  $result = curl_exec($ch);
			  curl_close ($ch);
		  }
		 exit;
	  ?>