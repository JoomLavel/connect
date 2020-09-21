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
    private $folderName;
    protected $dir;
    protected $defaultTemplate;
    protected $templateDirectory;
    protected $workplaceDirectory;
    private $componentDirectory;

    /**
     * ComponentGenerator constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->dir = $config['general']['path'];
        $this->defaultTemplate = $config['rad']['templates']['default'];
        $this->templateDirectory = $config['rad']['templates']['path'];
        $this->workplaceDirectory = $config['rad']['workplace']['path'];

        //TODO: check if template folder exists
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
        $dirFrom = $this->dir . $seperator . '..' . $seperator . $this->templateDirectory;
        $dirTo = $this->dir . $seperator . '..' . $seperator . $this->workplaceDirectory;
        $command = "Xcopy /E /I ";

        $this->componentDirectory = $dirTo . $seperator . $this->folderName;

        $finalCommand = $command . $dirFrom . $seperator . $this->defaultTemplate . " " . $this->componentDirectory;


        return exec($finalCommand);
    }

    /**
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