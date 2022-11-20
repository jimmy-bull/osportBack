<?php

namespace Aimeos\Admin\JQAdm\Products;

class Factory extends \Aimeos\Admin\JQAdm\Common\Factory\Base implements \Aimeos\Admin\JQAdm\Common\Factory\Iface
{
    public static function create(\Aimeos\MShop\Context\Item\Iface $context, string $name = null): \Aimeos\Admin\JQAdm\Iface
    {
        if ($name === null) {
            $name = $context->getConfig()->get('admin/jqadm/products/name', 'Standard');
        }

        $iface = '\\Aimeos\\Admin\\JQAdm\\Iface';
        $classname = '\\Aimeos\\Admin\\JQAdm\\Products\\' . $name;

        if (ctype_alnum($name) === false) {
            throw new \Aimeos\Admin\JQAdm\Exception(sprintf('Invalid characters in class name "%1$s"', $classname));
        }

        $client = self::createAdmin($context, $classname, $iface);

        return self::addClientDecorators($context, $client, 'products');
    }
}
