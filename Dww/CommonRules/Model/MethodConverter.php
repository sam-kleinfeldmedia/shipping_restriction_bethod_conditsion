<?php



namespace Dww\CommonRules\Model;

class MethodConverter
{
    /**
     * @var \Magento\Shipping\Model\Config
     */
    private $shippingConfig;

    /**
     * @var array
     */
    private $methods = [];

    public function __construct(
        \Magento\Shipping\Model\Config $shippingConfig
    ) {
        $this->shippingConfig = $shippingConfig;
    }

    /**
     * Convert comma-separated string of shipping methods codes to string with labels of that methods
     *
     * @param string $methodsStr
     *
     * @return string
     */
    public function convert($methodsStr)
    {
        $methods = $this->getCarrierMethods();
        $result = [];
        //$currentMethods = explode(',', $methodsStr);
        $currentMethods = explode(',', $methodsStr ?? '');

        foreach ($currentMethods as $currentMethod) {
            if (!empty($currentMethod) && array_key_exists($currentMethod, $methods)) {
                $result[] = $methods[$currentMethod];
            }
        }

        return implode('<br>', $result);
    }

    /**
     * Return array of shipping method codes, which label contains $likeValue.
     *
     * @param string $likeValue
     *
     * @return array|string
     */
    public function getCodes($likeValue)
    {
        $likeValue = trim(str_replace('%', '', $likeValue));

        if (stripos('Any', $likeValue) !== false) {
            return '';
        }

        $methods = $this->getCarrierMethods();

        return array_keys(array_filter($methods, function ($var) use ($likeValue) {
            return stripos($var, $likeValue) !== false;
        }));
    }

    /**
     * Return all shipping methods as array.
     * Format like: method_code => [carrier_code] + method_label
     *
     * @return array
     */
    public function getCarrierMethods()
    {
        if (!$this->methods) {
            $methods = [];
            $carriers = $this->shippingConfig->getAllCarriers();

            /** @var \Magento\Shipping\Model\Carrier\CarrierInterface $carrierModel */
            foreach ($carriers as $carrierCode => $carrierModel) {
                $carrierMethods = $carrierModel->getAllowedMethods();

                if (!$carrierMethods) {
                    continue;
                }

                foreach ($carrierMethods as $methodCode => $methodTitle) {
                    $methods = $this->collectMethods($methodCode, $methodTitle, $carrierCode, $methods);
                }
            }

            $this->methods = $methods;
        }

        return $this->methods;
    }

    /**
     * @param string $methodCode
     * @param string|\Magento\Framework\Phrase|string[]|\Magento\Framework\Phrase[] $methodTitle
     * @param string $carrierCode
     * @param array $methods
     * @param false $asOptgroup
     *
     * @return array
     */

    public function collectMethods(
        string $methodCode,
        $methodTitle,
        string $carrierCode,
        array $methods,
        $asOptgroup = false
    ): array {
        if (is_array($methodTitle)) {
            foreach ($methodTitle as $title) {
                $methods = $this->collectMethods($methodCode, $title, $carrierCode, $methods, false);
            }
        } else {
            if ($methodTitle instanceof \Magento\Framework\Phrase) {
                $methodTitle = (string)$methodTitle;
            }

            $label = $carrierCode . '_' . $methodCode;

            if (!empty($methodTitle)) {
                $label = '[' . $carrierCode . '] ' . $methodTitle;
            }

            if ($asOptgroup) {
                $methods[$carrierCode]['optgroup'][] = [
                    'value' => $carrierCode . '_' . $methodCode,
                    'label' => $label
                ];
            } else {
                $key = $carrierCode;

                if (strpos($carrierCode, '_') === false) {
                    $key = $carrierCode . '_' . $methodCode;
                }

                $methods[$key] = '[' . $carrierCode . '] ' . $methodTitle;
            }
        }

        return $methods;
    }
}
