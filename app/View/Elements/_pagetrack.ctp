<?php if($add_jq){ ?>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<?php } ?>
<script type='text/javascript'>
    $(function() {
        // Set the data text
        var dataText = 'page=<?php echo $_SERVER['REQUEST_URI']; ?>&referrer=<?php echo @$_SERVER['HTTP_REFERER']; ?>';
        // Create the AJAX request
        $.ajax({
            type: "POST",                    // Using the POST method
            url: "<?php echo $this->Html->url('/_pagetrack'); ?>",             // The file to call
            data: dataText,                  // Our data to pass
            success: function(res) {            // What to do on success
                console.log( '- page view has been added to the statistics!' );
                //console.log( res );
            },
            error: function(){
                console.log('failed page stat');
            }
        });
    });
</script>

