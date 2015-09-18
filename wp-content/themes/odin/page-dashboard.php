<?php 
    get_header();
    //Criar um frame principal, que construa e destrua partes de um template filho. 
      
      //Criar um archive que liste as praias do rio de janeiro com os seguintes campos:
        //Definir uma extensão inicial e uma extensão final de geolocalização
        //Exibir uma imagem de destaque
        //Exibir uma descrição da praia
        //Exibir a lista de quiosques da região
        //Exibir posts dos quiosques em uma timeline
        //Exibir uma galeria de imagens da praia enviadas por usuários conectados
        //Exibir depoimentos e comentários de usuários que já frequentaram a praia através de 
        //Exibir um 
      //Criar uma single de praias

      //Criar um thema filho

      //Criar um require_once
        //Verificar se o usuário realizou login;
        //Verificar se o usuário realizou check-in; 
        //Verificar se o usuário possui geolocation.
        //Verificar se o geolocation pertence há algum lote¹
          //¹Lote é o nome dado há uma determinada função que armazena 
          //geolocations de uma determinada região.


        //Dashboard:
          //Exibir o nome da praia
          //Exibir informações climáticas e marítimas
          //Exibir Quantidade de estabelecimentos registrados
            //Definir uma busca avançada
            //Filtro por aproximação
            //Filtro por avaliação
          //Exibir posts de estabelecimentos conectados próximo ao seu geolocation

        //Profile:
          //Verificar o tipo de profile(Comerciante/usuário)
            //Profile

            //Exibir foto de capa, nome, status(aberto/fechado), 
            //Exibir nome
            //Exibir status



?>



<?php
  
    if (!is_user_logged_in()) {
        wp_redirect( home_url() );    
    }else{

      get_currentuserinfo();

      echo 'Username: ' . $current_user->user_login . "\n"; 
      echo 'User email: ' . $current_user->user_email . "\n";
      echo 'User level: ' . $current_user->user_level . "\n";
      echo 'User first name: ' . $current_user->user_firstname . "\n";
      echo 'User last name: ' . $current_user->user_lastname . "\n";
      echo 'User display name: ' . $current_user->display_name . "\n";
      echo 'User ID: ' . $current_user->ID . "\n";

    }

?> 

<?php
    //get_footer();
?>