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
            //$squares = str_split($position);
        }

        $game = new Game($position);
        
        if ($game->winner('x')) 
        {
            echo '"x" win.';
        } else if ($game->winner('o'))
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
    
    class Game
    {
        var $position;
        
        function __construct($squares)
        {
            $this->position = str_split($squares);
        }
        
        public function winner($token) 
        {
            $won = false;
            
            for($row=0; $row<3; $row++)
            {
                if (($this->position[3*$row] == $token) && 
                    ($this->position[3*$row+1] == $token) && 
                    ($this->position[3*$row+2] == $token))
                {
                    $won = true;
                } else if (($this->position[$row] == $token) && 
                    ($this->position[$row+3] == $token) && 
                    ($this->position[$row+6] == $token))
                {
                    $won = true;
                }   
            }

            if (($this->position[0] == $token) &&
                ($this->position[5] == $token) &&
                ($this->position[8] == $token)) 
            {
                $won = true;
            } else if (($this->position[2] == $token) &&
                       ($this->position[5] == $token) &&
                       ($this->position[6] == $token)) 
            {
                $won = true;
            }

            return $won;
        }
    }    
?>