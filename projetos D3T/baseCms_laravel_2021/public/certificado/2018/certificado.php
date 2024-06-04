<?php
setlocale(LC_CTYPE,NULL);
header('Content-Type: text/html; charset=UTF-8');
		$user = "cmsdb";
		$password = 'e$pK$69v';
		try{
			$conn = new PDO('mysql:host=api.o2.ag;dbname=ingressos_2019', $user, $password);
    }catch (PDOException $e){
        echo $e;
    }
    if(isset($_GET['codigo'])){
        $codigo = addslashes($_GET['codigo']);
        $consulta = $conn->prepare("SELECT ingresso_nome AS nome FROM tb_ingresso WHERE ingresso_codigo = '".$codigo."' AND ingresso_checkin = 1");  
        $consulta->execute();
        $linha = $consulta->fetch(PDO::FETCH_ASSOC);
        if(count($linha)>0 && $linha['nome'] != ''){
        	$nome = $linha['nome']; 
        	
            header("Content-type: image/jpeg");
            $qtnI=0;
            $im = imagecreatefromjpeg("certificado.jpg");
            $grey = imagecolorallocate($im, 255, 255, 255);
            
            $text = utf8_encode(strtoupper($nome));
            $spl = str_split($text);
            for($i = 0;$i<count($spl);$i++){
                if($spl[$i]=="I"){
                    $qtnI = $qtnI + 30;
                }
            }
            $tamImg = 3508/2;
            $tamString = ((strlen($text)*30)-$qtnI)/2;
            $center = $tamImg - $tamString;
            imagettftext($im, 44, 0, $center, 1105, $grey, "font/font/HelveticaNeueLTStd-BdCn.ttf",$text);
            imagejpeg($im);
            imagedestroy($im);
            
        }else{
            echo "C&oacute;digo Inexistente";
        }
    }
    
?>