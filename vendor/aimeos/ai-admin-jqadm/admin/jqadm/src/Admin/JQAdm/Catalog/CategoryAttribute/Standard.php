<?php 
namespace Aimeos\Admin\JQAdm\CustomPanel\CategoryAttribute;

sprintf( 'categoryAttribute' ); // for translation

class Standard
    extends \Aimeos\Admin\JQAdm\Common\Admin\Factory\Base
    implements \Aimeos\Admin\JQAdm\Common\Admin\Factory\Iface
{
    public function copy() : ?string
    {
        return parent::copy();
    }

    public function create() : ?string
    {
        return parent::create();
    }

    public function delete() : ?string
    {
        return parent::delete();
    }

    public function export() : ?string
    {
        return parent::export();
    }

    public function get() : ?string
    {
        return parent::get();
    }

    public function save() : ?string
    {
        return parent::save();
    }

    public function search() : ?string
    {
        return parent::search();
    }

    public function getSubClient( string $type, string $name = null ) : \Aimeos\Admin\JQAdm\Iface
    {
        return $this->createSubClient( 'CustomPanel/CategoryAttribute/' . $type, $name );
    }

    protected function getSubClientNames() : array
    {
        return $this->getContext()->getConfig()->get( 'admin/jqadm/CustomPanel/CategoryAttribute/subparts', [] );
    }
}