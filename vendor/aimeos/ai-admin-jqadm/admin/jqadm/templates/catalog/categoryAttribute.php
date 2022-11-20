<?php
$enc = $this->encoder();
?>
<div id="categoryAttribute" class="item-mysubpanel tab-pane fade" role="tabpanel" aria-labelledby="mysubpanel">

    <div class="box">
        <!-- <div class="row">
            <div class="col-xl-6 vue <?= $this->site()->readonly($this->get('mysubpanelData/mysubpanel.siteid')); ?>"
                data-data="<?= $enc->attr($this->get('mysubpanelData', new stdClass())) ?>">

            
            <div>
        <div> -->
        my custom view
        <div>

            <?= $this->get('categoryAttribute'); ?>
        </div>
    </div>
</div>