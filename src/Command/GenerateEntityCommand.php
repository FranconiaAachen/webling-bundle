<?php

namespace Terminal42\WeblingBundle\Command;

use Symfony\Component\Filesystem\Filesystem;
use Terminal42\WeblingApi\Command\GenerateEntityCommand as BaseCommand;

class GenerateEntityCommand extends BaseCommand
{
    public function __construct(Filesystem $filesystem = null)
    {
        if (null === $filesystem) {
            $filesystem = new Filesystem();
        }

        parent::__construct($filesystem);
    }

    protected function configure()
    {
        parent::configure();

        $this->setName('webling:generate');
    }
}