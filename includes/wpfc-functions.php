<?php

use WPFCTracking\Inludes\FreteClick;

function wpfc_tracking(){


    ?>
    <form  method="post">
        <input type="tel" name="orderId" id="orderId" placeholder="OderId">
        <input type="tel" name="document" id="document" placeholder="CPF / CNPJ">
        <input type="submit" name="submit" value="RASTREAR">
    </form>

    <?php

    if(isset($_POST['submit'])){

        $data = array(
            'orderId'   => preg_replace("/[^0-9]/","", $_POST['orderId']),
            'document'  => preg_replace("/[^0-9]/","", $_POST['document'])
        );

        $result =  FreteClick::get_track($data);


        echo "<pre>";

        var_dump($result);
        echo "</pre>";

    }

    
}
