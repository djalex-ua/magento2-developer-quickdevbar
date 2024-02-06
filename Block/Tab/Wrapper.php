<?php

namespace ADM\QuickDevBar\Block\Tab;

use Magento\Framework\Api\SimpleDataObjectConverter;
use Magento\Framework\View\Element\AbstractBlock;

class Wrapper extends Panel
{
    protected $_mainTabs;

    protected $_jsonHelper;
    /**
     * @var \ADM\QuickDevBar\Helper\Data
     */
    private $qdbHelper;
    /**
     * @var \ADM\QuickDevBar\Helper\Register
     */
    private $qdbHelperRegister;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \ADM\QuickDevBar\Helper\Data $qdbHelper,
        \ADM\QuickDevBar\Helper\Register $qdbHelperRegister,
        array $data = []
    ) {
        $this->_jsonHelper = $jsonHelper;

        parent::__construct($context, $data);
        $this->qdbHelper = $qdbHelper;
        $this->qdbHelperRegister = $qdbHelperRegister;
    }

    public function getTabBlocks()
    {
        if ($this->_mainTabs === null) {
            $this->_mainTabs = $this->getLayout()->getChildBlocks($this->getNameInLayout());
        }

        return $this->_mainTabs;
    }

    public function getSubTabSuffix()
    {
        return SimpleDataObjectConverter::snakeCaseToCamelCase(str_replace('.', '_', $this->getNameInLayout()));
    }

    public function getUiTabClass()
    {
        return ($this->getIsMainTab()) ? 'qdb-ui-tabs' : 'qdb-ui-subtabs';
    }
}
