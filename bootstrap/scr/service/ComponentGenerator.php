<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 14.09.2020
 * Time: 20:11
 */

namespace App\Service;

class ComponentGenerator
{
    const DEFAULT_TEMPLATE = 'joomlavelcnct';
    const TEMPLATE_DIR = 'templates';
    const WORKPLACE_DIR = 'workplace';

    private $folderName;
    protected $dir;
    private $componentDirectory;

    public function __construct(string $dir)
    {
        $this->dir = $dir;

        //check if template folder exists
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function setComponentName(string $name)
    {
        $this->folderName = strtolower($name);

        return true;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function copyTemplateToDirectory()
    {
        $seperator = '\\';
        $dirFrom = $this->dir . $seperator . '..' . $seperator . $this::TEMPLATE_DIR;
        $dirTo = $this->dir . $seperator . '..' . $seperator . $this::WORKPLACE_DIR;
        $command = "Xcopy /E /I ";

        $this->componentDirectory = $dirTo . $seperator . $this->folderName;

        $finalCommand = $command . $dirFrom . $seperator . $this::DEFAULT_TEMPLATE . " " . $this->componentDirectory;


        return exec($finalCommand);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function cleanDirectory()
    {
        //exec();

        return true;
    }

    /**
     * @return mixed
     */
    public function getComponentDirectory()
    {
        return $this->componentDirectory;
    }
}