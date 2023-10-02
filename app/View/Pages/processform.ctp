<div class="pt-120">
    <h1 class="text-center">Form Submission</h1>
</div>

<div class="text-center">
    <?php
    if(isset($response['status'])){
        if($response['status'] && isset($response['data'])){
            echo '<h4 class="text-success">Success!</h4>';
            echo '<p>'. $response['data']['message'] . '</p>';
        } else {
            echo '<p class="text-danger">form submission was not successful</p>';
        }
    }
    ?>
</div>

<br>
<br>
<br>