<?php

/**
 * This file is part of the PaymentSuite package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 */

namespace PaymentSuite\RedsysBundle\Services;

use Symfony\Component\Routing\RouterInterface;

class UrlFactory
{
    /**
     * @var RouterInterface
     *
     * Router instance
     */
    private $router;


    /**
     * @param RouterInterface $router                         Router instance
     * @param string          $successRouteName               Route name for a succesful payment return from Paypal
     * @param string          $failRouteName                  Route name for a cancelled payment from Paypal
     */
    public function __construct(
        RouterInterface $router,
        $successRouteName,
        $failRouteName)
    {

        $this->router = $router;
        $this->successRouteName = $successRouteName;
        $this->failRouteName = $failRouteName;
    }

    public function getReturnUrlOkForOrderId($orderId)
    {
        return $this->router->generate(
            $this->successRouteName,
            array('id' => $orderId),
            true
        );
    }

    public function getReturnUrlKoForOrderId($orderId)
    {
        return $this->router->generate(
            $this->failRouteName,
            array('id' => $orderId),
            true
        );
    }
}
