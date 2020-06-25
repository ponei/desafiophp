<style>
.formulario {
    font: 95% Arial, Helvetica, sans-serif;
	max-width: 400px;
	margin: 10px auto;
	padding: 40px;
	background: #171717;
    border-radius: 40px 40px 0px 0px;
}

.formulario input[type=text],
.formulario input[type=password]  {
    display: block;
    margin-right: auto;
    margin-left: auto;
	outline: none;
	width: 70%;
	background: #2e2e2e;
	border: 1px solid #505050;
    border-radius: 25px;
	padding: 3%;
	color: #fff;
	font: 95% Arial, Helvetica, sans-serif;
}

.formulario input[type=submit] {
    border-radius: 25px;
	width: 40%;
	padding: 3%;
    display: block;
    margin-right: auto;
    margin-left: auto;
	background: #502359;
	border-bottom: 2px solid #391940;
	border-top-style: none;
	border-right-style: none;
	border-left-style: none;
    font: 110% Arial, Helvetica, sans-serif;	
	color: #fff;
}
</style>
<?php
if (isset($_GET['atividade'])) { //se param de atividade existe
    $atividadeNum = $_GET['atividade']; //pega numero da ativ
    if (is_numeric($atividadeNum)) { //se param é numero
        if ($atividadeNum != 8) { //se atividade nao for 8
            if (isset($_GET['texto'])) { //se param de texto existir
                $atividadeTexto = urldecode($_GET['texto']); //decode do param de texto
                $resultado = "erro (?)"; //default
                switch ($atividadeNum) {
                    case 1:
                        //se tamanho for maior ou igual a 8
                        if (strlen($atividadeTexto) >= 8) {
                            $resultado = "A palavra " . $atividadeTexto . " possui " . strlen($atividadeTexto) . " caracteres - sua inicial é \"" . substr($atividadeTexto, 0, 1) . "\"";
                        } else {
                            $resultado = "A palavra " . $atividadeTexto . " possui " . strlen($atividadeTexto) . " caracteres - suas iniciais são \"" . substr($atividadeTexto, 0, 3) . "\"";
                        }
                        break;
                    case 2:
                    //substitui espaço com hifem
                        $resultado = str_replace(" ", "-", $atividadeTexto);
                        break;
                    case 3:
                    //substitui vogais com interrogação
                        $vogais = ["a", "e", "i", "o", "u"];
                        $resultado = str_replace($vogais, "?", $atividadeTexto);
                        break;
                    case 4:
                    //3 ultimos caracteres
                        $resultado = substr($atividadeTexto, -3);
                        break;
                    case 5:
                    
                        if (isset($_GET['data'])) { //se param de data existe
                            $atividadeData = strtotime($_GET['data']); //pega param de data e transforma pra data (objeto)
                            $nomeSeparado = explode(' ', $atividadeTexto); //separa texto em arrays
                            $ultimoNome = array_pop($nomeSeparado); //ultimo array
                            $resultado = $ultimoNome . " - Data -> Dia: " . date("d", $atividadeData) . " Mês: " . date("m", $atividadeData) . " Ano: " . date("Y", $atividadeData);
                        }
                        break;
                    case 6:
                        $resultado = strrev($atividadeTexto); //so inverte o texto
                        break;
                    case 7:
                        $resultado = "<a href=\"https://" . strrev($atividadeTexto) . "\">Link funcional</a>"; //texto invertido dentro de um href
                        break;
                }
                echo $resultado; //echo no treco
            }
        } else if ($atividadeNum == 8) { //se atividade for 8, coloca formulario com css la em cima
            echo '<form class="formulario" action="#">';
            echo '<input type="text" id="name" value=""><br><br>';
            echo '<input type="password" id="pass" value=""><br><br>';
            echo '<input type="submit" value="Login">';
            echo '</form>';
        }
    }
}
