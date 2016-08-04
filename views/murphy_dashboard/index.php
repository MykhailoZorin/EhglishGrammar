<?php require_once './views/header.php'; ?>

<div class="container">
    <div class="column" style="background: #E6F2C0;">
        <span class="title"><b>DASHBOARD: UNIT #<?= $this->unitId; ?></b> <br />
        <?= $this->unitTitle; ?></span>
        <hr>
        Description of the unit: <span class="message"></span> <input type="button" id="add_desc" value="Save" style="float: right;" /><br />
        <textarea id="desc_content" style="width: 100%; height: 550px;"><?= $this->description; ?></textarea>
    </div>
    
    <div class="column" style="background: #EBF5CC; height: 640px;">
        <span class="title"><br />
            Exercises
        </span>
        <hr>
        
        <?php
        
            echo "<input type='hidden' title='unitId' id='". $this->unitId ."'/>";
            echo "xxx";
        ?>
        
    </div>
</div>

<?php require_once './views/footer.php'; ?>
