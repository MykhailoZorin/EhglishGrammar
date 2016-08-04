<?php require_once './views/header.php'; ?>

<div class="container" >
    <div class="column" >
        <span class="title"><b>UNIT <?= $this->unitId; ?></b> <?= $this->unitTitle; ?></span>
        <hr>
        <?= $this->description; ?>
    </div>
    <div class="column" >
        <span class="title">Exercises</span>
        <hr>
        
        <?php
        
            echo "<input type='hidden' title='unitId' id='". $this->unitId ."'/>";
            for($i = 0; $i < count($this->exercises); ++$i) {
                
                echo $this->exercises[$i]['description'];
                
                $questions = $this->exercises[$i]['questions'];

                if(count($questions) != 0) {
                    
                    $tag = ($this->exercises[$i]['isUnordered'] == false) ? '<ol class="list_question">' : '<ul class="list_question">';
                    $tagClosed = ($this->exercises[$i]['isUnordered'] == false) ? '</ol>' : '</ul>';
                    
                    echo $tag;
                    for($j = 0; $j < count($questions); ++$j) {

                        echo '<li>', $questions[$j], "</li>";
                    }
                    echo $tagClosed;
                }
                
                echo "<small><b>exerciseID = " , $this->exercises[$i]['id'], "</b></small><br />";
                echo  "<hr />";
            }
        ?>
        
    </div>
</div>

<?php require_once './views/footer.php'; ?>
