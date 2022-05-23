<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class WizardObject extends BaseObject
{
    /**
     * @var WizardStepObject[]
     */
    protected $steps = [];

    /**
     * @return WizardStepObject[]
     */
    public function getSteps(): array
    {
        return $this->steps;
    }

    /**
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        foreach ($data->row as $step) {
            $this->steps[] = new WizardStepObject($step);
        }
    }
}