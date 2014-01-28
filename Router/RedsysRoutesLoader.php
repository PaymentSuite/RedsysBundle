<?php

/**
 * RedsysBundle for Symfony2
 *
 * This Bundle is part of Symfony2 Payment Suite
 *
 * @author Gonzalo Vilaseca <gonzalo.vilaseca@gmail.com>
 * @package RedsysBundle
 *
 * Gonzalo Vilaseca 2014
 */

namespace PaymentSuite\RedsysBundle\Router;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Redsys router
 */
class RedsysRoutesLoader implements LoaderInterface
{

    /**
     * @var string
     *
     * Execution route name
     */
    private $controllerRouteName;


    /**
     * @var string
     *
     * Execution controller route
     */
    private $controllerRoute;


    /**
     * @var boolean
     *
     * Route is loaded
     */
    private $loaded = false;


    /**
     * Construct method
     *
     * @param string $controllerRouteName Controller route name
     * @param string $controllerRoute     Controller route
     */
    public function __construct($controllerRouteName, $controllerRoute)
    {
        $this->controllerRouteName = $controllerRouteName;
        $this->controllerRoute = $controllerRoute;
    }


    /**
     * Loads a resource.
     *
     * @param mixed  $resource The resource
     * @param string $type     The resource type
     *
     * @return RouteCollection
     *
     * @throws RuntimeException Loader is added twice
     */
    public function load($resource, $type = null)
    {
        if ($this->loaded) {

            throw new \RuntimeException('Do not add this loader twice');
        }

        $routes = new RouteCollection();
        $routes->add($this->controllerRouteName, new Route($this->controllerRoute, array(
            '_controller'   =>  'RedsysBundle:Redsys:execute',
        )));

        $this->loaded = true;

        return $routes;
    }


    /**
     * Returns true if this class supports the given resource.
     *
     * @param mixed  $resource A resource
     * @param string $type     The resource type
     *
     * @return boolean true if this class supports the given resource, false otherwise
     */
    public function supports($resource, $type = null)
    {
        return 'redsys' === $type;
    }


    /**
     * Gets the loader resolver.
     *
     * @return LoaderResolverInterface A LoaderResolverInterface instance
     */
    public function getResolver()
    {
    }


    /**
     * Sets the loader resolver.
     *
     * @param LoaderResolverInterface $resolver A LoaderResolverInterface instance
     */
    public function setResolver(LoaderResolverInterface $resolver)
    {
    }
}