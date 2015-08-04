<?php

namespace Khill\Lavacharts\Configs\UIs;

use \Khill\Lavacharts\Configs\Options;
use \Khill\Lavacharts\DataTables\Formats\NumberFormat;

class NumberRangeUI extends DataRange
{
    /**
     * Type of UI config object
     *
     * @var string
     */
    const TYPE = 'NumberRangeUI';

    /**
     * Builds a new NumberRangeUI object.
     *
     * @param array $config Array of options to set
     * @throws \Khill\Lavacharts\Exceptions\InvalidConfigValue
     * @return self
     */
    public function __construct($config = [])
    {
        $options = new Options($this->defaults);
        $options->extend($this->extDefaults);

        parent::__construct($options, $config);
    }

    /**
     * Sets the format for numbers in the control.
     *
     * @access public
     * @param  \Khill\Lavacharts\DataTables\Formats\NumberFormat
     * @return self
     */
    public function format(NumberFormat $format)
    {
        return $this->setOption(__FUNCTION__, $format);
    }
}
