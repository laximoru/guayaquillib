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

    /** @var string[] */
    protected $params;

    /**
     * @param string $command
     * @param string[] $params
     */
    public function __construct(string $operation, array $params, string $service)
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


}