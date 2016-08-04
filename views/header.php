<!DOCTYPE html>
<html>
    <head>
        <title>English Grammar</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href='http://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="<?= PATH ?>public/css/default.css" />
        <script type="text/javascript" src="<?php echo PATH ?>public/js/jquery.js"></script>
        
        <?php

            if(isset($this->js)) {
                
                echo '<script type="text/javascript" src="'
                        . PATH . 
                        'views/'.$this->js.'.js"></script>';
            }
        ?>
        
    </head>
    <body>
