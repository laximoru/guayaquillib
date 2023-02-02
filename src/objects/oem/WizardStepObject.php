<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class WizardStepObject extends BaseObject
{

    /**
     * @var bool
     */
    protected $allowListVehicles;

    /**
     * @var bool
     */
    protected $automatic;

    /**
     * @var string
     */
    protected $conditionId;

    /**
     * @var bool
     */
    protected $determined;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $ssd;

    /**
     * @var WizardStepOptionObject[]
     */
    protected $options = [];

    /**
     * @return bool
     */
    public function isAllowListVehicles(): bool
    {
        return $this->allowListVehicles;
    }

    /**
     * @return bool
     */
    public function isAutomatic(): bool
    {
        return $this->automatic;
    }

    /**
     * @return string
     */
    public function getConditionId(): string
    {
        return $this->conditionId;
    }

    /**
     * @return bool
     */
    public function isDetermined(): bool
    {
        return $this->determined;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getSsd(): string
    {
        return $this->ssd;
    }

    /**
     * @return WizardStepOptionObject[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }


    /**
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        $this->allowListVehicles = (string)$data['allowlistvehicles'] == 'true';
        $this->automatic = (string)$data['automatic'] == 'true';
        $this->conditionId = (string)$data['conditionid'];
        $this->determined = (string)$data['determined'] == 'true';
        $this->name = (string)$data['name'];
        $this->type = (string)$data['type'];
        $this->value = (string)$data['value'];
        $this->ssd = (string)$data['ssd'];

        if ($data->options instanceof SimpleXMLElement) {
            foreach ($data->options->row as $option) {
                $this->options[] = new WizardStepOptionObject($option);
            }
        }
    }
}