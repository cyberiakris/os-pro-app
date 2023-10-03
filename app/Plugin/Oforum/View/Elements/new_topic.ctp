<div id="newtopic" class="overlay">
    <div class="popup">
        <h2>New Topic</h2>
        <a class="close" href="#">&times;</a>
        <div class="content">
            <?php //echo $this->element('post_editor_plain'); ?>
            <?php echo $this->element('post_editor'); ?>
        </div>
    </div>
</div>



<style>
    .overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.5);
        transition: opacity 200ms;
        visibility: hidden;
        opacity: 0;
    }
    .overlay.light {
        background: rgba(255, 255, 255, 0.5);
    }
    .overlay .cancel {
        position: absolute;
        width: 100%;
        height: 100%;
        cursor: default;
    }
    .overlay:target {
        visibility: visible;
        opacity: 1;
    }

    .popup {
        margin: 75px auto;
        padding: 20px;
        background: #fff;
        border: 1px solid #666;
        width: 90%;
        height: 67%;
        box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
        position: relative;
    }
    .light .popup {
        border-color: #aaa;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
    }
    .popup h2 {
        margin-top: 0;
        color: #666;
        font-family: "Trebuchet MS", Tahoma, Arial, sans-serif;
    }
    .popup .close {
        position: absolute;
        width: 20px;
        height: 20px;
        top: 20px;
        right: 20px;
        opacity: 0.8;
        transition: all 200ms;
        font-size: 24px;
        font-weight: bold;
        text-decoration: none;
        color: #666;
    }
    .popup .close:hover {
        opacity: 1;
    }
    .popup .content {
        max-height: 400px;
        overflow: auto;
    }
    .popup p {
        margin: 0 0 1em;
    }
    .popup p:last-child {
        margin: 0;
    }

</style>