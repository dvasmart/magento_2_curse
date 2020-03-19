<?php

namespace Vitalii\Test\Preference\Model;

use Vitalii\Test\Model\CarCustomerModel;

/**
 * Class PreferenceModel
 */
class PreferenceModel extends CarCustomerModel
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return __('FromPreference: ')->render() . $this->getData(self::NAME);
    }
}
