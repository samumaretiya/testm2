<?php

namespace Digital\Faqs\Model;

class Status
{
    /**#@+
     * Status values
     */
    const STATUS_ENABLED = 0;

    const STATUS_DISABLED = 1;
	const FAQ_NORMAL_VALUE = 0;
    const FAQ_EZICREDIT_VALUE = 1;
    const FAQ_NORMAL_LABLE = "Normal";
    const FAQ_EZICREDIT_LABLE = "Ezicredit";
    /**
     * Retrieve option array
     *
     * @return string[]
     */
    public static function getOptionArray()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
    
    public function getFaqTypeArray(){
		return [self::FAQ_NORMAL_VALUE => self::FAQ_NORMAL_LABLE, self::FAQ_EZICREDIT_VALUE => self::FAQ_EZICREDIT_LABLE];
	}

    /**
     * Retrieve option array with empty value
     *
     * @return string[]
     */
    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }

    /**
     * Retrieve option text by option value
     *
     * @param string $optionId
     * @return string
     */
    public function getOptionText($optionId)
    {
        $options = self::getOptionArray();

        return isset($options[$optionId]) ? $options[$optionId] : null;
    }
}
