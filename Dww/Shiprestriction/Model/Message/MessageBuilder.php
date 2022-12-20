<?php



namespace Dww\Shiprestriction\Model\Message;

/**
 * Class MessageBuilder
 */
class MessageBuilder
{
    /**
     * @param string $message
     * @param array $products
     * @return string
     */
    public function parseMessage($message, $products)
    {
        $allProducts = implode(', ', $products);
        $lastProduct = end($products);
        $newMessage = str_replace('{all-products}', $allProducts, $message ?? '');
        $newMessage = str_replace('{last-product}', $lastProduct, $newMessage ?? '');

        return $newMessage;
    }
}
