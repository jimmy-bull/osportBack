<?php
$enc = $this->encoder();

use App\Http\Controllers\GetProducts;

$target = $this->config('admin/jqadm/url/search/target');
$controller = $this->config('admin/jqadm/url/search/controller', 'Jqadm');
$action = $this->config('admin/jqadm/url/search/action', 'search');
$config = $this->config('admin/jqadm/url/search/config', []);

$searchParams = $params = $this->get('pageParams', []);
$searchParams['page']['start'] = 0;
?>
<?php $this->block()->start('jqadm_content'); ?>
<div class="vue-block">
    <nav class="main-navbar">
        <span class="navbar-brand">
            <div>
                <?php
                echo GetProducts::getHomeWithID($_GET['id'])[0]->name;
                ?> / Product worth: $<?php echo GetProducts::getHomeWithID($_GET['id'])[0]->price; ?> / Product estimation:
                $<?php echo (GetProducts::getEstimations($_GET['id'])); ?>
            </div>
        </span>

        <?= $this->partial(
            $this->config('admin/jqadm/partial/navsearch', 'common/partials/navsearch-standard'),
            [
                'filter' => $this->session('aimeos/admin/jqadm/mypanel/filter', []),
                'filterAttributes' => $this->get('filterAttributes', []),
                'filterOperators' => $this->get('filterOperators', []),
                'params' => $params,
            ]
        ); ?>
    </nav>

    <?= $this->partial(
        $this->config('admin/jqadm/partial/pagination', 'common/partials/pagination-standard'),
        [
            'pageParams' => $params, 'pos' => 'top', 'total' => $this->get('total'),
            'page' => $this->session('aimeos/admin/jqadm/products/page', [])
        ]
    );
    ?>


    <div class="container">
        <div class="accordion v1">
            <div class="a-container active">
                <p class="a-btn">Images <span></span></p>
                <div class="a-panel">
                    <h4>This are the images for the product.</h4>
                    <div class="imageBox">
                        <?php foreach (GetProducts::getImage($_GET['id']) as $key => $value) {

                        ?>
                            <div>
                                <img class="rounded img-thumbnail float-start" src="/storage/<?php echo explode("public/", $value->image_link)[1] ?>" alt="">
                            </div>
                        <?php     }; ?>
                    </div>
                </div>
            </div>
            <div class="a-container">
                <p class="a-btn">Product Characteristics <span></span></p>
                <div class="a-panel">

                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Characteristic name</th>
                                <th scope="col">Characteristic value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (GetProducts::getCharacteristics($_GET['id']) as $key => $value) {
                            ?>
                                <tr>
                                    <td><?php echo $value->attr_type ?></td>
                                    <td><?php echo $value->attr_values ?></td>
                                </tr>
                            <?php     }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class="a-container">
                <p class="a-btn">Products estimations <span></span></p>
                <div class="a-panel">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Characteristic name</th>
                                <th scope="col">Characteristic value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (GetProducts::getCharacteristics($_GET['id']) as $key => $value) {
                            ?>
                                <tr>
                                    <td><?php echo $value->attr_type ?></td>
                                    <td><?php echo $value->attr_values ?></td>
                                </tr>
                            <?php     }; ?>
                        </tbody>
                    </table>
                </div>
            </div> -->
        </div>
    </div>


    <?php if (GetProducts::getHomeWithID($_GET['id'])[0]->status == 0) {
    ?>
        <form action="/api/setProductDate" method="get">
            <div class="datePickerblock">
                <div>
                    <h6>Start date</h6>
                    <input is="flat-pickr" required name="start" class="form-control listitem-datestart select" type="datetime-local" tabindex="1" />
                </div>
                <div>
                    <h6>End date</h6>
                    <input required is="flat-pickr" name="end" class="form-control listitem-dateend select" type="datetime-local" tabindex="2" />
                </div>

            </div>
            <div style="display: flex;justify-content:center;margin-top:10px">
                <button type="submit" style="align-self: center;" type="button" class="btn btn-primary col-lg-6">Accept</button>
            </div>
            <input type="text" name="article_id" value="<?php echo $_GET['id']; ?>" hidden id="">
        </form>

        <div style="display: flex;justify-content:flex-end">
            <button type="button" id="myBtn" class="btn btn-danger jsModalTrigger">Refuse</button>
        </div>
    <?php } else {  ?>
        <div style="display: flex;justify-content:flex-end">
            <button type="button" class="btn btn-danger jsModalTrigger">Back to review mode</button>
        </div>
    <?php } ?>

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close closeListMOdal">&times;</span>
                <h5>Message for the user</h5>
            </div>
            <div class="modal-body">
                <form action="/api/declineProduct" method="get">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Message</label>
                        <input type="text" multiple class="form-control" name='message' id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Tell the user why you declined his product</div>
                    </div>
                    <div style="display: flex;justify-content:center;margin-top:10px">
                        <button type="submit" style="align-self: center;" type="button" class="btn btn-primary col-lg-6">send</button>
                    </div>
                    <input type="text" name="article_id" value="<?php echo $_GET['id']; ?>" hidden id="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">close</button>
            </div>
        </div>

    </div>
</div>
<?php $this->block()->stop(); ?>
<?= $this->render($this->config('admin/jqadm/template/page', 'common/page-standard')); ?>

<style>
    .datePickerblock {
        display: flex;
        justify-content: center;
    }

    .datePickerblock div {
        width: 40%;
        margin: 10px;
    }

    th {
        text-transform: uppercase;
        font-size: 13px;
    }

    .imageBox {
        display: flex;
        justify-content: space-evenly;
        flex-wrap: wrap;
        height: auto;
    }

    .imageBox div {
        margin-top: 20px;
        cursor: pointer;
    }

    .imageBox div img {
        height: 250px;
        width: 250px;
        object-fit: contain;
    }

    .embla {
        overflow: hidden;
    }

    .embla__container {
        display: flex;
    }

    .embla__slide {
        position: relative;
        flex: 0 0 100%;
    }

    .container {
        display: flex;
        flex-direction: column;
        width: 100%;
        /* max-width: 1000px; */
        /* margin: 0 auto; */
        padding: 10px 10px 100px 10px;


    }

    .container h1 {
        text-align: center;
        margin-bottom: 30px;
        font-weight: 500;
    }

    .container h2 {
        font-weight: 500;
    }

    .accordion {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: auto;
    }

    .accordion .a-container {
        display: flex;
        flex-direction: column;
        width: 100%;
        padding-bottom: 5px;
    }

    .accordion .a-container .a-btn {
        margin: 0;
        position: relative;
        padding: 15px 30px;
        width: 100%;
        color: #bdbdbd;
        font-weight: 400;
        display: block;
        font-weight: 500;
        background-color: #262626;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        border-radius: 5px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, .15), 0 10px 10px -5px rgba(0, 0, 0, .1) !important;
    }

    .accordion .a-container .a-btn span {
        display: block;
        position: absolute;
        height: 14px;
        width: 14px;
        right: 20px;
        top: 18px;
    }

    .accordion .a-container .a-btn span:after {
        content: '';
        width: 14px;
        height: 3px;
        border-radius: 2px;
        background-color: #fff;
        position: absolute;
        top: 6px;
    }

    .accordion .a-container .a-btn span:before {
        content: '';
        width: 14px;
        height: 3px;
        border-radius: 2px;
        background-color: #fff;
        position: absolute;
        top: 6px;
        transform: rotate(90deg);
        transition: all 0.3s ease-in-out;
    }

    .accordion .a-container .a-panel {
        width: 100%;
        color: #262626;
        transition: all 0.2s ease-in-out;
        opacity: 0;
        height: auto;
        max-height: 0;
        overflow: scroll;
        padding: 0px 10px;
    }

    .accordion .a-container.active .a-btn {
        color: #fff;
    }

    .accordion .a-container.active .a-btn span::before {
        transform: rotate(0deg);
    }

    .accordion .a-container.active .a-panel {
        padding: 15px 10px 10px 10px;
        opacity: 1;
        max-height: 500px;
    }

    .btn {
        margin: 0px 10px 0px 10px;
    }


    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 100000;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 50%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    @keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    /* The Close Button */
    .close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        padding: 2px 16px;
        background-color: #5cb85c;
        color: white;
    }

    .modal-body {
        padding: 2px 16px;
    }

    .modal-footer {
        /* padding: 2px 16px;
        background-color: #5cb85c;
        color: white; */
    }
</style>