<?php

namespace GuayaquilLib;

class Command
{
    /** @var string */
    protected $operation;

    /** @var string */
    protected $command;

    /** @var string */
    protected $service;

    /** @var string */
    protected $responseClassName;

    /** @var bool */
    protected $isResponseArray;

    /** @var string[] */
    protected $params;

    /**
     * @param string $operation
     * @param string[] $params
     * @param string $service
     * @param string $responseClassName
     * @param bool $isResponseArray
     */
    public function __construct(string $operation, array $params, string $service, string $responseClassName, bool $isResponseArray)
    {
        $this->operation = $operation;
        $this->params = $params;

        $command = $operation . ':';
        $first = true;
        foreach ($params as $key => $value) {
            if ($first) {
                $first = false;
            } else {
                $command .= '|';
            }
            $command .= $key . '=' . $value;
        }

        $this->command = $command;
        $this->service = $service;
        $this->responseClassName = $responseClassName;
        $this->isResponseArray = $isResponseArray;
    }

    /**
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * @return string
     */
    public function getCommand(): string
    {
        return $this->command;
    }

    /**
     * @return string[]
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    public function getResponseClassName(): string
    {
        return $this->responseClassName;
    }

    public function isResponseArray(): bool
    {
        return $this->isResponseArray;
    }
}