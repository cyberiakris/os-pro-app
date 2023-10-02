<?php echo $this->set('title_for_layout', $content['post_title']); ?>

<?php
$this->Html->addCrumb( "Blog", array('controller' => 'blogs', 'action' => 'index'));
$this->Html->addCrumb($content['post_title']);
?>

<div class="row">
    <div class="col-md-12">
        <h2><?php echo $content['post_title']; ?></h2>
    </div>
    <div class="col-md-12">
        <?php echo $content['post_content']; ?>
    </div>
</div>

