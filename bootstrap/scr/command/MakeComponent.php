<?php
/**
 * Created by PhpStorm.
 * User: Jakub Walczak
 * Date: 14.09.2020
 * Time: 18:50
 */

namespace App\Command;

use App\Service\ComponentGenerator;
use App\Service\ZipGenerator;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MakeComponent extends Command
{
    const NAME = 'JoomLavel-connect';

    protected static $defaultName = 'make:component';
    protected $io;
    protected $componentDirectory;

    private $componentGenerator;

    private $verbosityDescription;
    private $verbosity;

    public function __construct(string $dir)
    {
        parent::__construct();

        $this->componentGenerator = new ComponentGenerator($dir);
    }

    protected function configure()
    {
        $this
            ->addArgument('name', InputArgument::OPTIONAL, 'The name of the new component.')
            ->addOption(
                'zip',
                'z',
                InputOption::VALUE_NONE,
                'Do you want to zip the component for Joomla import?'
            )
            ->setDescription('Creates a new Joomla component based on a JoomLavel-connector template')
            ->setHelp('This command allows you to create a Joomla component. This component can be used to add API, especially JoomLavel API support. Open API 3.0 is also supported.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
        $this->verbosity = $output->isVerbose();

        $this->io->title('Component Creator');

        if ($input->getArgument('name') == true) {
            $name = $input->getArgument('name');

        } else {
            $name = $this::NAME;
        }
        $output->writeln('Create component with name: ' . $name);

        $this->createComponent($name);

        if ($input->getOption('zip') == true && isset($this->componentDirectory)) {
            $zipGenerator = new ZipGenerator();
            $this->verbosityDescription .= "\n". count($zipGenerator->zipDirectory($name, $this->componentDirectory), true)." files zipped";
        }

        if ($this->verbosity) {
            $this->io->note($this->verbosityDescription);
        }

        $output->writeln("");
        $output->write('Component ' . $name . ' successfully created');
        if ($input->getOption('zip') == true && isset($this->componentDirectory)) {
            $output->write(' and zipped.');
        }else{
            $output->write('.');
        }

        return Command::SUCCESS;
        // return Command::FAILURE;
    }

    private function createComponent(string $name)
    {
        $this->io->progressStart($this->componentGenerator->getSteps());
        if ($this->verbosity) {
            $this->io->note("getSteps()");
        }

        $this->componentGenerator->setComponentName($name);
        $this->io->progressAdvance();
        if ($this->verbosity) {
            $this->io->note("setComponentName(" . $name . ")");
        }
        $this->verbosityDescription .= $this->componentGenerator->copyTemplateToDirectory();
        $this->componentDirectory = $this->componentGenerator->getComponentDirectory();
        $this->io->progressAdvance();
        if ($this->verbosity) {
            $this->io->note("copyTemplateToDirectory()");
        }
        $this->componentGenerator->cleanDirectory();
        if ($this->verbosity) {
            $this->io->note("cleanDirectory()");
        }
        $this->io->progressAdvance();
    }
}