<?php



namespace Dww\CommonRules\Model;

/**
 * Class Module
 */
class Module
{
    const SHIPPING_RULES_MODULE_NAMESPACE = 'Amasty_Shiprules';

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    private $request;

    /**
     * Module constructor.
     * @param \Magento\Framework\App\RequestInterface $request
     */
    public function __construct(
        \Magento\Framework\App\RequestInterface $request
    ) {
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getModuleName()
    {
        return $this->request->getModuleName();
    }

    /**
     * @param $moduleNamespace
     * @return string
     */
    public function getModuleAlias($moduleNamespace)
    {
        return strtolower($moduleNamespace);
    }

    /**
     * @return bool
     */
    public function isShippingRulesMethod()
    {
        return $this->getModuleName()
            == $this->getModuleAlias(self::SHIPPING_RULES_MODULE_NAMESPACE);
    }
}
