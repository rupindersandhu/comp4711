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
            $game = new Game($position);
        }
        else
        {
            $game = new Game("---------");
        }

        $game->pick_move();
        
        $game->display();

        if ($game->winner('x')) 
        {
            echo 'You Lose';
        } else if ($game->winner('o'))
        {
            echo 'You Win.';
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
                ($this->position[4] == $token) &&
                ($this->position[8] == $token)) 
            {
                $won = true;
            } else if (($this->position[2] == $token) &&
                       ($this->position[4] == $token) &&
                       ($this->position[6] == $token)) 
            {
                $won = true;
            }

            return $won;
        }
        
        public function display() 
        {
          echo '<table cols=”3” style=”font-size:large; font-weight:bold”>';
          echo '<tr>'; // open the first row
          for ($pos = 0; $pos < 9; $pos++) 
          {
            echo $this->show_cell($pos);
            if (($pos % 3) == 2) 
            {
                echo '</tr><tr>'; // start a new row for the next square
            }
          }
          echo '</tr>'; // close the last row
          echo '</table>';
        }
        
        function show_cell($which) 
        {
          $token = $this->position[$which];
          // deal with the easy case
          if ($token <> '-') 
          {
              return '<td>'.$token.'</td>';
          }
        
          // now the hard case
          $this->newposition = $this->position; // copy the original
          $this->newposition[$which] = 'o'; // this would be their move
          $move = implode($this->newposition); // make a string from the board array
          $link = '/comp4711/index.php/?board='.$move; // this is what we want the link to be
          // so return a cell containing an anchor and showing a hyphen
          return '<td><a href="'.$link.'">-</a></td>';
        }
        
        function pick_move()
        {
            $temp = array();
            if(!$this->winner('x') || !$this->winner('o'))
            {
                for($i = 0; $i < count($this->position); $i++)
                {
                    if($this->position[$i] == '-')
                    {
                        array_push($temp, $i);
                    }
                }
                if(count($temp) > 1)
                {
                    $tempSize = count($temp);
                    $val = $temp[rand(0, $tempSize-1)];
                    $this->position[$val] = 'x';
                }
            }
        }
    }    
?>