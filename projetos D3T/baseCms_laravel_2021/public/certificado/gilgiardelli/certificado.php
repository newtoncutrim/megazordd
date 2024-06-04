<?php
setlocale(LC_CTYPE,NULL);
header('Content-Type: text/html; charset=ISO-8859-1');
     $user = "eventoho_hoje";
    $password = "hoje897";
    try{
      $conn = new PDO('mysql:host=localhost;dbname=eventoho_certificados', $user, $password);
    }catch (PDOException $e){
        echo $e;
    }
    if(isset($_GET['codigo'])){
        $codigo = addslashes($_GET['codigo']);
        $consulta = $conn->prepare("SELECT * FROM participantes2 where codigo = :codigo");
        $consulta->bindParam(':codigo', $codigo);
        $consulta->execute();
        $linha = $consulta->fetch(PDO::FETCH_ASSOC);
        if(count($linha)>0 && $linha['nome']!=""){
            $nome = $linha['nome'];
            header("Content-type: image/jpeg");
            $qtnI=0;
            $im = imagecreatefromjpeg("modelo_certificado.jpg");
            $grey = imagecolorallocate($im, 51, 51, 51);

            $text = mb_strtoupper($nome,'ISO-8859-1');
            $spl = str_split($text);
            for($i = 0;$i<count($spl);$i++){
                if($spl[$i]=="I"){
                    $qtnI = $qtnI + 20;
                }
            }
            $tamImg = 3508/2;
            $tamString = ((strlen($text)*30)-$qtnI)/2;
            $center = $tamImg - $tamString;
            imagettftext($im, 36, 0, $center, 993, $grey, "font/Uniform Light.ttf",$text);
            imagejpeg($im);
            imagedestroy($im);

        }else{
            echo "C&oacute;digo Inexistente";
        }
    }

?>
