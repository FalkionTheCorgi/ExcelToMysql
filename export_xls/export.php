<?php
    //declaramos uma variavel para monstarmos a tabela
    $dadosXls  = "";
    $dadosXls .= "  <table border='1' >";
    $dadosXls .= "          <tr>";
    $dadosXls .= "          <th>Id</th>";
    $dadosXls .= "          <th>data_distribuicao</th>";
    $dadosXls .= "          <th>local</th>";
    $dadosXls .= "          <th>nome</th>";
    $dadosXls .= "          <th>raca</th>";
    $dadosXls .= "          <th>rg</th>";
    $dadosXls .= "          <th>orgao_expedidor</th>";
    $dadosXls .= "          <th>cpf</th>";
    $dadosXls .= "          <th>contato</th>";
    $dadosXls .= "          <th>sexo</th>";
    $dadosXls .= "          <th>endereco</th>";
    $dadosXls .= "          <th>bairro</th>";
    $dadosXls .= "          <th>renda_familiar</th>";
    $dadosXls .= "          <th>composicao_familiar</th>";
    $dadosXls .= "          <th>beneficios</th>";
    $dadosXls .= "          <th>data_nascimento</th>";
    $dadosXls .= "      </tr>";
    //incluimos nossa conexão
    // CONEXAO BANCO DE DADOS AQUI
    //varremos o array com o foreach para pegar os dados
    foreach($result as $res){
        $dadosXls .= "      <tr>";
        $dadosXls .= "          <td>".$res['id']."</td>";
        $dadosXls .= "          <td>".$res['data_distribuicao']."</td>";
        $dadosXls .= "          <td>".utf8_decode($res['local'])."</td>";
        $dadosXls .= "          <td>".utf8_decode($res['nome'])."</td>";
        $dadosXls .= "          <td>".$res['raca']."</td>";
        $dadosXls .= "          <td>".$res['rg']."</td>";
        $dadosXls .= "          <td>".$res['orgao_expedidor']."</td>";
        $dadosXls .= "          <td>".$res['cpf']."</td>";
        $dadosXls .= "          <td>".$res['contato']."</td>";
        $dadosXls .= "          <td>".$res['sexo']."</td>";
        $dadosXls .= "          <td>".utf8_decode($res['endereco'])."</td>";
        $dadosXls .= "          <td>".utf8_decode($res['bairro'])."</td>";
        $dadosXls .= "          <td>".utf8_decode($res['renda_familiar'])."</td>";
        $dadosXls .= "          <td>".utf8_decode($res['composicao_familiar'])."</td>";
        $dadosXls .= "          <td>".$res['beneficios']."</td>";
        $dadosXls .= "          <td>".$res['data_nascimento']."</td>";
        $dadosXls .= "      </tr>";
    }
    $dadosXls .= "  </table>";
 
    // Definimos o nome do arquivo que será exportado  
    $arquivo = "Duplicados.xls";  
    // Configurações header para forçar o download  
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$arquivo.'"');
    header('Cache-Control: max-age=0');
    // Se for o IE9, isso talvez seja necessário
    header('Cache-Control: max-age=1');
       
    // Envia o conteúdo do arquivo  
    echo $dadosXls;  
    exit;
?>
