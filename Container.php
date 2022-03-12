<?php
namespace Dream\Container;
use \Closure;
use Dream\Contracts\Container\ContainerInterface;
class Container implements ContainerInterface
{
	//容器的绑定
	protected $binds = [];
	//容器的共享实例
	protected $instances = [];

	/**
	 * 向容器注册绑定
	 * @param     string       $abstract 绑定标识
	 * @param     Closure      $concrete 绑定内容
	 */
    public function bind($abstract, Closure $concrete)
    {
    	$this->binds[$abstract] = $concrete;
    }

    /**
	 * 共享的绑定
	 * @param     string     $abstract 绑定标识
	 * @param     mixed      $concrete 绑定内容
	 */
    public function instance($abstract, $concrete)
    {
    	$this->instances[$abstract] = $concrete;
    }

    /**
	 * 从容器中获取绑定
	 * @param     string     $abstract   绑定标识
	 * @param     array      $parameters 参数
	 */
    public function make($abstract, array $parameters = [])
    {
    	if(!isset($this->binds[$abstract])){
    		return null;
    	}
    	array_unshift($parameters, $this);
    	return call_user_func_array($this->binds[$abstract], $parameters);
    }

    public function a()
    {
        echo 222;
    }

}