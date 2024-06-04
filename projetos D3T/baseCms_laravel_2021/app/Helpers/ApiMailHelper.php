<?php
namespace App\Helpers;

class ApiMailHelper
{
	public static function sendEmail($assunto, $mensagem, $destinatarios = false, $fromName = false, $fromMail = false){
		$htmlMsg = '';
		if(is_array($mensagem)){
			foreach ($mensagem as $key => $value) {
				$htmlMsg .= utf8_encode(addslashes("{$key}: {$value} <br>"));
			}
		}else{
			$htmlMsg = utf8_encode($mensagem);
		}

		$data['authenticator'] = '806adc3e6dd06acf29fc72b5195d20f8';
		$data['from_name'] = "Evento HOJE 2021";
		$data['from'] = "naoresponda@odoisgo.com";
		$data['id_assunto'] = "";
		$data['assunto'] = $assunto;
		$data['port'] = "587";
		$data['mailer'] = "smtp";
		$data['host'] = "smtp.gmail.com";
		$data['senha_from'] = "o2multi897";
		$data['mensagem'] = utf8_decode($htmlMsg);
		$url = 'https://api.o2.ag/api_cms/email/automacao/';
		
		if($destinatarios != ""){
			$data['destinatarios'] = $destinatarios;
		} else {
			$data['destinatarios'] = 'vinicius@a9p.com.br';
		}
		
		$data = json_encode($data);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$resposta = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($status == 200){
			return $resposta;
			curl_close($ch);
		} else {
			return $status;
			curl_close($ch);
		}
	}

	public static function sendEmailFile($assunto, $mensagem, $file = false){
		$htmlMsg = '';
		if(is_array($mensagem)){
			foreach ($mensagem as $key => $value) {
				$htmlMsg .= utf8_encode(addslashes("{$key}: {$value} <br>"));
			}
		}else{
			$htmlMsg = utf8_encode($mensagem);
		}

		$data['authenticator'] = '806adc3e6dd06acf29fc72b5195d20f8';
		$data['from_name'] = "Evento HOJE 2021";
		$data['from'] = "naoresponda@odoisgo.com";
		$data['id_assunto'] = "";
		$data['assunto'] = $assunto;
		$data['port'] = "587";
		$data['mailer'] = "smtp";
		$data['tem_arquivo'] = 1;
		$data['host'] = "smtp.gmail.com";
		$data['senha_from'] = "o2multi897";
		$data['mensagem'] = utf8_decode($htmlMsg);
		$url = 'https://api.o2.ag/api_cms/email/automacao/';
		$data['destinatarios'] = 'vinicius@a9p.com.br';
		$data = json_encode($data);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$resposta = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($status == 200){
			return $resposta;
			curl_close($ch);
		} else {
			return $status;
			curl_close($ch);
		}
	}

	public static function sendFile($emailId, $files)
    {
        $url = "https://api.o2.ag/api_cms/email/arquivo/{$emailId}/?authenticator=806adc3e6dd06acf29fc72b5195d20f8";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_VERBOSE, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
        curl_setopt($curl, CURLOPT_URL, ($url));
        curl_setopt($curl, CURLOPT_POST, true);

        $filesArray = $files;
        if (!is_array($files)) {
            $filesArray = [$files];
        }

        $post = [];
        foreach ($filesArray as $key => $file) {
            $post[$key] = curl_file_create(
                $file->getPathName(),
                $file->getMimeType(),
                $file->getClientOriginalName()
            );
        }
        
        /* ATUALMENTE API DE ENVIO DE E-MAILS CONSEGUE ENVIAR APENAS 1 ANEXO POR EMAIL */
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        $fileName = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		if($status == 200){
			return $fileName;
			curl_close($curl);
		} else {
			return $status;
			curl_close($curl);
		}
    }

	public static function sendFunil($tags,$firstname,$email){
		$data['tags'] = $tags;
		$data['firstname'] = $firstname;
		$data['email'] = $email;
		$data_json = json_encode($data);

		$curl = curl_init();

		curl_setopt_array($curl, [
			CURLOPT_URL => "https://eventohoje.d3tmkt.com.br/api/contacts/new",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $data_json,
			CURLOPT_COOKIE => "be7d8e0fc4a483022cf6967a05a76bdb=9g7cjr4l7fgu8r2e0cmkcj5co6",
			CURLOPT_HTTPHEADER => [
				"Authorization: Basic YWRtaW46cHJvQDEzNQ==",
				"Content-Type: application/json"
			],
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
	}

}
