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


class MakeComponent extends GenericCommand
{

    const NAME = 'JoomLavel-connect';
    const TITLE = 'Component Creator';
    const STEPS = 4;

    private $steps;

    protected static $defaultName = 'make:component';
    protected $componentDirectory;

    public $componentGenerator;


    public function __construct(array $config)
    {
        parent::__construct();

        $this->componentGenerator = new ComponentGenerator($config);
        $this->steps = $this::STEPS;
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
        $this->showIntro($input, $output);

        !$input->getOption('zip') ?: $this->steps++;

        $name = $input->getArgument('name') == true ? $input->getArgument('name') : $this::NAME;
        $output->writeln('Create component with name: ' . $name);
        $this->createComponent($name);

        if ($input->getOption('zip') == true && isset($this->componentDirectory)) {
            $zipGenerator = new ZipGenerator();
            $this->addVerbosityDescription(count($zipGenerator->zipDirectory($name, $this->componentDirectory), true) . " files zipped");
            $this->addCommentAndProgressBar("zipDirectory()");
            $note = " and zipped";
        } else {
            $note = ".";
        }

        $this->showEndNote($output);

        $output->writeln("");
        $output->write('Component ' . $name . ' successfully created' . $note);

        return Command::SUCCESS;
    }

    private function createComponent(string $name)
    {
        $this->addProgressBar($this->steps);

        $this->addCommentAndProgressBar("setComponentName(" . $name . ")");
        $this->componentGenerator->setComponentName($name);

        $this->addCommentAndProgressBar("copyTemplateToDirectory()");
        $this->addVerbosityDescription($this->componentGenerator->copyTemplateToDirectory());
        $this->componentDirectory = $this->componentGenerator->getComponentDirectory();

        $this->addCommentAndProgressBar("cleanDirectory()");
        $this->componentGenerator->cleanDirectory();

        $this->addCommentAndProgressBar("finish()");
    }

}