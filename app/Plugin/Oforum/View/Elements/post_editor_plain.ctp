<form id="form" method="post">

    <input type="text" name="post_title" class="form-control" />

    <div class="editor" id="post_content">
        <h1>JQUERY NOTEBOOK DEMO</h1>
        <p>A simple, clean and elegant text editor. Inspired by the awesomeness of <a href="http://medium.com" target="_blank">Medium</a>.</p>
        <p>This jQuery plugin is released under the MIT license. You can check out the project and see how extremely simple it is to use this editor on your application by clicking on the Github ribbon on the top corner of this page. Feel free to contribute with this project by registering any bug that you may encounter as an issue on Github, and working on the issues that are already there. I'm looking forward to seeing your pull request!</p>
        <p>Now, just take a time to test the editor. Yes, <b>this div is the editor</b>. Try to edit this text, select a part of this text and don't forget to try the basic text editor keyboard shortcuts.</p>
    </div>
    <br>
    <input class="btn btn-info btn-lg" type="submit" value="Submit" />
</form>

<?php echo $this->Html->css('Oforum.jquery.notebook.css'); ?>
<?php echo $this->Html->script('Oforum.jquery.notebook.js'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.editor').notebook({
            autoFocus: true,
            placeholder: 'Type something awesome...'
        });
    });
</script>
