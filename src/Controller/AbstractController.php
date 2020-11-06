<?php


namespace ToDoApp\Controller;


use Throwable;
use ToDoApp\Exception\ConfigurationException;
use ToDoApp\Exception\NotFoundException;
use ToDoApp\Exception\StorageException;
use ToDoApp\Model\NoteModel;
use ToDoApp\Request;
use ToDoApp\View;
use function ToDoApp\dump;

abstract class AbstractController
{
    const DEFAULT_ACTION = 'list';
    private static array $configuration;
    protected View $view;
    protected Request $request;
    protected NoteModel $model;

    /**
     * AbstractController constructor.
     * @param Request $request
     * @throws ConfigurationException
     */
    public function __construct(Request $request)
    {
        try {
            $this->model = new NoteModel(self::$configuration);
            $this->view = new View();
            $this->request = $request;
        } catch (Throwable $e) {
            throw new ConfigurationException("Configuration error", 400, $e);
        }

    }
    public static function initConfiguration($configuration)
    {
        self::$configuration = $configuration;
    }

    final public function run()
    {
        try {
            $action = $this->action() . 'Action';
            $this->$action();
        } catch (StorageException $e) {
            $this->view->render('error', ['action' => $this->request->getParam('action')]);
        }
    }

    final private function action() : string
    {
        return $this->request->getParam('action', self::DEFAULT_ACTION);
    }

    protected function redirect(array $params) : void
    {
        if (count($params)) {
            $urlParams = [];
            foreach ($params as $key => $value) {
                array_push($urlParams, urlencode($key) . "=" .urlencode($value));
            }
            $urlParams = implode("&", $urlParams);
            $location = "?";
            $location .= $urlParams;
            header("Location: $location");
        }
    }


}