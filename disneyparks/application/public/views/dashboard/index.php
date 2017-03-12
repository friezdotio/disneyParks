<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="navbar">
    <div class="navbar-inner">
        <a class="brand" href="#">WaffleFry API Dashboard</a>
    </div>
</div>
<div id="main" class="container">

    <table class="table table-striped">
        <tr>
            <td><b>Method</b></td>
            <td><b>Params</b></td>
            <td><b>Action</b></td>
        </tr>
        <?php foreach ($classArray as $class=>$methodArray) { ?>
            <h3><?php echo $class ?></h3>
            <?php foreach ($methodArray as $method=>$paramArray) { ?>
                <tr>
                    <form id="<?php echo $method ?>" method="post">
                        <td>
                            <span class="label label-success" style="font-size:11pt;padding:5px;">
                                <?php echo $method ?>
                            </span>
                        </td>
                        <td>
                            <p>
                                <input type="hidden" name="method" value="<?php echo $method; ?>">
                                <?php foreach($paramArray as $param=>$isOptional){
                                    if($param == '1' || $param == '0'){ 
                                        echo ''; 
                                    }
                                    else{
                                        if($isOptional == true){
                                            $optional = ' <span style="color:#808080;">(optional)</span>';
                                        }
                                        else{
                                            $optional = '';
                                        }
                                        echo '<input style="height:25px;" type="text" name="' . $param . '_' . $method . '" placeholder="' . $param . '">' . $optional . '<br>';
                                    }
                                } ?>
                            </p>
                        </td>
                        <td>
                            <input type="submit" value="Execute">
                        </td>
                    </form>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>
    <div>
        <h3>Output</h3>
        <pre id="output"></pre>
    </div>
</div>
<script>
    <?php foreach ($classArray as $class=>$methodArray) {
        foreach ($methodArray as $method=>$paramArray) {
            if($_POST['method'] == $method){
                echo '$.post( "' . $url . '/' . $method;
                foreach($paramArray as $param=>$isOptional){
                    if($param == '1' || $param == '0'){ 
                    }
                    else{
                        if(isset($_POST[$param . '_' . $method])){
                            echo '/' . $_POST[$param . '_' . $method];
                        }
                    }
                }
                echo '", function( data ) { $( "#output" ).html( data );});';
            }
        } 
     } ?>
</script>