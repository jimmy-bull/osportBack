<?php

namespace Aimeos\Admin\JQAdm\Products;

sprintf('products'); // for translation

class Standard extends \Aimeos\Admin\JQAdm\Common\Admin\Factory\Base implements \Aimeos\Admin\JQAdm\Common\Admin\Factory\Iface
{
    public function copy(): ?string
    {
        return parent::copy();
    }

    public function create(): ?string
    {
        return parent::create();
    }

    public function delete(): ?string
    {
        return parent::delete();
    }

    public function export(): ?string
    {
        return parent::export();
    }

    public function get(): ?string
    {
        // return view('admin-home', ['id' => $this->require('id')]); //CUSTOM

        $view = $this->getView();


        try {
            ///$manager = \Aimeos\MShop::create($this->getContext(), 'mydomain');

            //$view->item = $this->require('id');
           // $view->itemData = $this->toArray($view->item);
            $view->itemBody = parent::get();
        } catch (\Exception $e) {
            $this->report($e, 'get');
        }

        $tplconf = 'admin/jqadm/products/list';
        $default = 'products/list';

        return $view->render($view->config($tplconf, $default));
    }

    public function save(): ?string
    {
        return parent::save();
    }

    public function search(): ?string
    {
        $view = $this->getView();

        try {
            $view->listBody = parent::search();
        } catch (\Exception $e) {
            $this->report($e, 'search');
        }

        $tplconf = 'admin/jqadm/products/template-list';
        $default = 'products/home';

        return $view->render($view->config($tplconf, $default));
    }

    public function getSubClient(string $type, string $name = null): \Aimeos\Admin\JQAdm\Iface
    {
        return $this->createSubClient('products/' . $type, $name);
    }

    protected function getSubClientNames(): array
    {
        return $this->getContext()->getConfig()->get('admin/jqadm/products/subparts', []);
    }
}
