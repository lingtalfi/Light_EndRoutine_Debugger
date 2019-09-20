<?php


namespace Ling\Light_EndRoutine_Debugger\Handler;

use Ling\ArrayToString\ArrayToStringTool;
use Ling\Light_EndRoutine\Handler\ContainerAwareLightEndRoutineHandler;
use Ling\Light_Logger\LightLoggerService;

/**
 * The LightEndRoutineDebuggerHandler class.
 */
class LightEndRoutineDebuggerHandler extends ContainerAwareLightEndRoutineHandler
{


    /**
     * This property holds the options for this instance.
     * Options for this class.
     *
     *
     * @var array
     */
    protected $options;

    /**
     * @overrides
     */
    public function __construct()
    {
        parent::__construct();
        $this->options = [];
    }


    /**
     * @implementation
     */
    public function handle()
    {


        $showSession = $this->options['showSession'] ?? false;
        $array = [];

        if (true === $showSession) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $array['SESSION'] = $_SESSION;
        }


        /**
         * @var $logger LightLoggerService
         */
        $logger = $this->container->get("logger");
        $logger->debug(ArrayToStringTool::toPhpArray([
            "---LightEndRoutineDebuggerHandler---" => $array,
        ]));
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Sets the options.
     *
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }


}