<?php
/**
 * Class BoostMyShopAgentClassesLog
 *
 * @author    BoostMyShop <contact@boostmyshop.com>
 * @copyright 2015-2019 BoostMyShop (http://www.boostmyshop.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class BoostMyShopAgentClassesLog
{
    private $filePath;

    const TYPE_INFO = 'info';
    const TYPE_ERROR = 'error';

    public function __construct()
    {
        $this->filePath = _PS_MODULE_DIR_ . 'boostmyshopagent/logs.txt';
        $this->deleteLogFile();
    }

    public function info($message)
    {
        $this->log($message, self::TYPE_INFO);
    }

    public function error($message)
    {
        $this->log($message, self::TYPE_ERROR);
    }

    public function log($message, $type)
    {
        $message = '[' . date('Y-m-d H:i:s') . '] [' . $type . '] ' . $message . "\n";
        $handle = fopen($this->filePath, 'a');
        fwrite($handle, $message);
        fclose($handle);
    }

    public function deleteLogFile()
    {
        if (!is_file($this->filePath)) {
            return;
        }

        $fileSize = filesize($this->filePath);
        if ($fileSize > 100 * 10000) {
            unlink($this->filePath);
        }
    }
}
