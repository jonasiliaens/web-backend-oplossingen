<?php
    
    $pagina = 'body';

    if (isset($_GET['page']))
    {
        $pagina = $_GET['page'];
    }

 


    $artikels = array(
                        array(  'title' => 'Parlementslid Jan Van Esbroeck van N-VA in mekaar geslagen in Brussel',
                                'body'  => 'Jan Van Esbroeck, die voor N-VA zetelt in het Vlaams parlement, is gisteren 
                                na de late zitting in mekaar geslagen in Brussel. Een foto van het toegetakelde aangezicht 
                                van de parlementariër circuleert op Twitter. Over de aanleiding of ware toedracht is momenteel nog niets bekend.',
                                'tags'  => array('Tag1' => 'Jan Van Esbroeck'),
                        ),
                        array(  'title' => 'Voetbalbelofte verlamd voor het leven na zware crash',
                                'body'  => 'Een Zambiaanse voetbalbelofte blijft voor het leven verlamd na een zwaar verkeersongeval waarin hij 
                                eerder deze week betrokken was. Changwe Kalale was met enkele ploegmaats op weg naar het trainingskamp van Zambia, 
                                als voorbereiding op de Africa Cup, toen hun minibus frontaal inreed op een personenwagen. Bij de crash vielen drie doden, 
                                waaronder beide chauffeurs. Nyambe Mulenga, eveneens Zambiaans international, liep een beenbreuk op, maar met de 17-jarige 
                                Kalale was het veel erger gesteld. Tests in het ziekenhuis wezen uit dat de jonge speler vanaf zijn middel verlamd blijft
                                 voor het leven.',
                                'tags'  => array('Tag1' => 'Voetbalbelofte',
                                                    'Tag2' => 'Changwe Kalale')
                        ),
                        array(  'title' => 'Nieuwpoortse burgemeester rijdt door licht dat al halve minuut op rood staat',
                                'body'  => 'De Nieuwpoortse burgemeester Roland Crabbe (71) is deze morgen door de politierechter in Brugge veroordeeld 
                                tot acht dagen rijverbod en een boete van 300 euro, waarvan de helft effectief. Op 4 februari van dit jaar reed hij met zijn 
                                wagen op de Ring rond Brugge door het rode licht. Dat stond al 31 seconden op rood toen Crabbe de overtreding maakte. Ik was 
                                me van geen kwaad bewust en ben dus allerminst opzettelijk door het rode licht gereden, zegt de burgervader. Eigenlijk kan ik 
                                me moeilijk voorstellen dat ik zo een overtreding maak, maar uiteraard twijfel ik niet aan de camerabeelden die bewijzen wat 
                                er is gebeurd.',
                                'tags'  => array('Tag1' => 'Nieuwpoortse burgemeester',
                                                    'Tag2' => 'Rood licht',
                                                    'Tag3' => 'Roland Crabbe')
                        )
                    );

    include 'view/header-partial.html';

    include 'view/'.$pagina.'-partial.html';

    include 'view/footer-partial.html';


?>