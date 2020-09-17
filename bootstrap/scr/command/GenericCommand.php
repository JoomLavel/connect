<?php
/**
 * Created by PhpStorm.
 * User: Jakub Walczak
 * Date: 14.09.2020
 * Time: 18:50
 */

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Style\SymfonyStyle;

class GenericCommand extends Command
{
    const TITLE = '<generic command>';

    public $io;
    public $verbosityDescription;
    public $verbosity;

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    }

    public function showIntro(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
        $this->verbosity = $output->isVerbose();

        $this->io->title($this::TITLE);
    }

    public function showEndNote()
    {
        !$this->verbosity ?: $this->io->note($this->verbosityDescription);
    }

    public function addVerbosityDescription(string $text)
    {
        $this->verbosityDescription .= "\n" . $text;
    }

    public function addCommentAndProgressBar(string $text)
    {
        !$this->verbosity ?: $this->io->note($text);
        $this->io->progressAdvance();
    }

    public function addProgressBar(int $steps)
    {
        $this->io->progressStart($steps);
    }
}