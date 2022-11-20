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
            <?= $enc->html($this->translate('admin', 'Products')); ?>
            <!-- <span class="navbar-secondary">(<?= $enc->html($this->site()->label()); ?>)</span> -->
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

    <div class="dropdownBloack show">
        <div class="dropdown">
            <button class="dropbtn">Filter</button>
            <div class="dropdown-content">
                <a href="#">Order By date</a>
                <a href="#">Order By status</a>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Label</th>
                <th scope="col">Status</th>
                <th scope="col">User</th>
                <th scope="col">Estimated price</th>
                <th scope="col">Created at</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (GetProducts::getHome() as $key => $value) {
            ?>
                <tr>
                    <td>
                        <a href="<?php echo "/admin/default/jqadm/get/products/" . $value->id . "?locale=en&id=" . $value->id ?>"><?php echo $value->name ?></a>
                    </td>
                    <td><?php echo $value->status ?></td>
                    <td><?php echo $value->user_email ?></td>
                    <td>$<?php echo $value->price ?></td>
                    <td><?php echo date_format($value->created_at, "Y/m/d H:i:s") ?></td>
                </tr>
            <?php     }; ?>
        </tbody>
    </table>

</div>
<?php $this->block()->stop(); ?>
<?= $this->render($this->config('admin/jqadm/template/page', 'common/page-standard')); ?>

<style>
    th {
        text-transform: uppercase;
        font-size: 13px;
    }

    .vue-block {
        padding: 20px;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    /* Style The Dropdown Button */
    .dropbtn {
        background-color: #007aff;
        color: white;
        padding: 5px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        right: 0;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {
        background-color: #f1f1f1
    }

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {
        /* background-color: rgba(0, 122, 255, 0.1); */
    }

    .dropdownBloack {
        display: flex;
        justify-content: flex-end;
    }
</style>