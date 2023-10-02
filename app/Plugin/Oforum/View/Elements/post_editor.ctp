<div>
<form id="form" method="post" action="<?php echo $this->Html->url('/forum/posts/add'); ?>">

    <select name="forum_topic_id" class="form-control">
    </select>

    <textarea name="content" id="editor"></textarea>

    <br>
    <input class="btn btn-info btn-lg" type="submit" value="Submit" />
</form>
</div>

<?php echo $this->Html->css('Oforum.bootstrap-markdown-editor.css'); ?>

<!-- script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script -->
<!-- script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ace.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/marked/0.3.2/marked.min.js"></script>

<?php echo $this->Html->script('Oforum.bootstrap-markdown-editor.js'); ?>

<script>

    jQuery(document).ready(function($) {

        $('#editor').markdownEditor({
            height: '200px',
            fullscreen: false,
            preview: true,
            onPreview: function (content, callback) {
                callback( marked(content) );
            }
        });

    });

</script>
