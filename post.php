<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors','0');
function respond(int $code, string $status, string $message, array $extra=[]): never {
    http_response_code($code); echo json_encode(array_merge(['status'=>$status,'message'=>$message],$extra),JSON_UNESCAPED_UNICODE); exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') respond(405,'error','POST required');
$amount = filter_var($_POST['amount'] ?? null,FILTER_VALIDATE_FLOAT);
if ($amount === false || !is_finite($amount) || $amount <= 0 || $amount > 10000000) respond(422,'error','Invalid amount');
$options = json_decode(file_get_contents(__DIR__.'/currency-options.json'),true);
$from = $_POST['fromCurrencyText'] ?? ''; $to = $_POST['toCurrencyText'] ?? '';
if (!is_string($from) || !is_string($to) || !isset($options['from'][$from],$options['to'][$to])) respond(422,'error','Unsupported currency choice');
$fromCode=$options['from'][$from]; $toCode=$options['to'][$to];
// Fixed presentation rates and fees; never live market data.
$converted = match ($fromCode.'-'.$toCode) {
    'USD-IQD'=>$amount*1470, 'IQD-USD'=>$amount/1470,
    'USD-USD'=>$amount-3, 'IQD-IQD'=>$amount-2000,
};
if ($converted <= 0) respond(422,'error','Amount below demonstration fee');
foreach (['walletAddress','cardCode'] as $key) {
    $value = $_POST[$key] ?? '';
    if (!is_string($value) || strlen($value)>500) respond(422,'error','Invalid recipient details');
}
$image=null;
if (isset($_FILES['uploadedImage']) && $_FILES['uploadedImage']['error'] !== UPLOAD_ERR_NO_FILE) {
    $upload=$_FILES['uploadedImage'];
    if ($upload['error'] !== UPLOAD_ERR_OK || $upload['size']>5*1024*1024 || !is_uploaded_file($upload['tmp_name'])) respond(422,'error','Invalid upload or file exceeds 5 MB');
    $mime=(new finfo(FILEINFO_MIME_TYPE))->file($upload['tmp_name']);
    if (!in_array($mime,['image/jpeg','image/png','image/webp'],true) || !getimagesize($upload['tmp_name'])) respond(422,'error','Proof must be JPEG, PNG or WebP');
    $image=['path'=>$upload['tmp_name'],'mime'=>$mime];
}
$demo = (getenv('DEMO_MODE') ?: '1') === '1';
$number = 'EX-'.strtoupper(bin2hex(random_bytes(5)));
if ($demo) respond(200,'success','Synthetic request accepted; no provider contacted',['operation_number'=>$number,'demo'=>true,'converted_amount'=>round($converted,2)]);
$token=getenv('TELEGRAM_BOT_TOKEN');$chat=getenv('TELEGRAM_CHAT_ID');
if (!$token || !$chat || !extension_loaded('curl')) respond(503,'error','Provider not configured');
$escape=fn(string $text)=>htmlspecialchars($text,ENT_QUOTES|ENT_SUBSTITUTE,'UTF-8');
$message="Exchange request $number\nFrom: ".$escape($from)."\nTo: ".$escape($to)."\nAmount: $amount\nDisplayed estimate: ".round($converted,2);
foreach (['walletAddress','cardCode'] as $key) if (!empty($_POST[$key])) $message.="\n$key: ".$escape($_POST[$key]);
$send=function(string $method,array $fields) use ($token): bool {
    $curl=curl_init('https://api.telegram.org/bot'.$token.'/'.$method);
    curl_setopt_array($curl,[CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>$fields,CURLOPT_RETURNTRANSFER=>true,CURLOPT_TIMEOUT=>20,CURLOPT_SSL_VERIFYPEER=>true,CURLOPT_SSL_VERIFYHOST=>2]);
    $raw=curl_exec($curl);$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);curl_close($curl);
    $result=is_string($raw)?json_decode($raw,true):null;
    return $code===200 && ($result['ok']??false);
};
$fields=['chat_id'=>$chat,'parse_mode'=>'HTML'];
if ($image) { $fields['caption']=$message;$fields['photo']=new CURLFile($image['path'],$image['mime'],'proof');$method='sendPhoto'; }
else { $fields['text']=$message;$method='sendMessage'; }
if (!$send($method,$fields)) respond(502,'error','Provider did not confirm delivery; contact operator before retrying');
respond(200,'success','Request sent',['operation_number'=>$number,'demo'=>false,'converted_amount'=>round($converted,2)]);
