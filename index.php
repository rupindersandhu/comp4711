<DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/hrml; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //
        $name = 'Jim';
        $what = 'geek';
        $level = 10;
        echo 'Hi, my name is '.$name,'. and I am a level '.$level.'
        '.$what;
        
        echo '<br/>';
        
        //$hoursworked = $_GET['hours'];
        $hoursworked = 10;
        $rate = 12;
        $total = $hoursworked * $rate;
        
        if ($hoursworked > 40) {
        $total = $hoursworked * $rate * 1.5;
        } else {
        $total = $hoursworked * $rate;
        }
        echo ($total > 0) ? 'You owe me '.$total : "You're welcome";
        echo '<br/>';

        if (isset($_GET['board']))
        {
            $position = $_GET['board'];
            $squares = str_split($position);
        }

        if (winner('x',$squares)) 
        {
            echo '"x" win.';
        } else if (winner('o',$squares))
        {
            echo '"o" win.';
        } else 
        {
            echo 'No winner yet.';
        }
        
        ?>
    </body>
</html>
    
<?php
    
    function winner($token,$position) 
    {
        $won = false;
        
        
        for($row=0; $row<3; $row++)
        {
            if (($position[3*$row] == $token) && 
                ($position[3*$row+1] == $token) && 
                ($position[3*$row+2] == $token))
            {
                $won = true;
            } else if (($position[$row] == $token) && 
                ($position[$row+3] == $token) && 
                ($position[$row+6] == $token))
            {
                $won = true;
            }   
        }
        
        if (($position[0] == $token) &&
            ($position[5] == $token) &&
            ($position[8] == $token)) 
        {
            $won = true;
        } else if (($position[2] == $token) &&
                   ($position[5] == $token) &&
                   ($position[6] == $token)) 
        {
            $won = true;
        }
        
        return $won;
    }
?>