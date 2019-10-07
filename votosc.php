<?
/*
Sistema de encuestas por candidatos para TV Digital.
Autor: HST
*/
/*
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}
*/

  define("CA", "ca.txt");
  define("CB", "cb.txt");
  define("CC", "cc.txt");
  define("CD", "cd.txt");
  define("CE", "ce.txt");
  define("CF", "cf.txt");

  function Archivo($fileName) {
     if(!file_exists($fileName))
        return 0;

     if($arc = fopen($fileName, "r+")) {
        $votosc = fgets($arc, 100);
        fclose($arc);
        return $votosc;
     }
     return 0;
  }

  function registrarVoto($fileName) {
     $votosc = Archivo($fileName);
     $votosc++;
     if($arc = fopen($fileName, "w+")) {
        fwrite($arc, $votosc);
        fclose($arc);
     }
     return $votosc;
  }

  function exhibirVotos() {
     $votosc = Archivo(CA);
     print("---------------------------------------------------------<br/>");
     print("APLICACION COCINA<br/>");
     print("---------------------------------------------------------<br/>");
     print("ME GUSTA ENCEBOLLADO: $votosc votos<br/>");

     $votosc = Archivo(CB);
     print("NO ME GUSTA ENCEBOLLADO: $votosc votos<br/>");

     $votosc = Archivo(CC);
     print("ME GUSTA CEVICHE: $votosc votos<br/>");

     $votosc = Archivo(CD);
     print("NO ME GUSTA CEVICHE: $votosc votos<br/>");
     
      $votosc = Archivo(CE);
     print("ME GUSTA MOUSSE: $votosc votos<br/>");

     $votosc = Archivo(CF);
     print("NO ME GUSTA MOUSSE: $votosc votos<br/>");
  }

  //Genera tabla LUA conteniendo los dados a ser utilizados
  //por la aplicación NCLua de TV Digital
  function TabladeVotos() {
     $votos = Archivo(CA);
     print("votos = { \n");
     print(" ca = $votos,  \n");

     $votos = Archivo(CB);
     print(" cb = $votos,  \n");

     $votos = Archivo(CC);
     print(" cc = $votos,  \n");

     $votos = Archivo(CD);
     print(" cd = $votos,  \n");
     
     $votos = Archivo(CE);
     print(" ce = $votos,  \n");
     
     $votos = Archivo(CF);
     print(" cf = $votos,  \n");
     
     print(" url = 'Registrado en HST' \n");
     print("}\n");
  }

  //---------------------------------------------------

  if(isset($_REQUEST["voto"])) {
	 $voto = strtolower($_REQUEST["voto"]);
	 if($voto == "ca" or $voto == "a")
	    $fileName = CA;
         if($voto == "cb" or $voto == "b")
	    $fileName = CB;
         if($voto == "cc" or $voto == "c")
	    $fileName = CC;
         if($voto == "cd" or $voto == "d")
	    $fileName = CD;
	    if($voto == "ce" or $voto == "e")
	    $fileName = CE;
         if($voto == "cf" or $voto == "f")
	    $fileName = CF;
	 registrarVoto($fileName);
	 TabladeVotos();
  }
  else exhibirVotos();
?>
