<?php


namespace ToDoApp\Controller;


use Throwable;
use ToDoApp\Exception\NotFoundException;
use ToDoApp\Exception\StorageException;
use function ToDoApp\dump;


class NoteController extends AbstractController
{
    public function createAction() : void
    {
        if ($this->request->hasPost()) {
            $params = [
                'title' => $this->request->postParam('title'),
                'description' => $this->request->postParam('description')
            ];
                $this->model->create($params);
                $this->redirect(['after' => 'created']);
        }
        $this->view->render('create');
    }
    public function listAction() : void
    {
        $data = [
            'phrase' =>$this->request->getParam('phrase', ""),
            'sort_by' => $this->request->getParam('sort_by', 'title'),
            'sort_order' => $this->request->getParam('sort_order', 'asc'),
            'page_size' => $this->request->getParam('page_size', '5'),
            'page' => $this->request->getParam('page', '1'),
        ];

        if ($data['phrase']) {
            $rows =  $this->model->search(
                $data['phrase'],
                $data['sort_by'],
                $data['sort_order'],
                $data['page_size'],
                $data['page']
            );
            $count = ceil($this->model->searchCount($data['phrase']) / (int) $data['page_size']);
        } else {
            $rows =  $this->model->list(
                $data['sort_by'],
                $data['sort_order'],
                $data['page_size'],
                $data['page']
            );
            $count = ceil($this->model->count() / (int) $data['page_size']);
        }

        $afterParam = $this->request->getParam("after");


        $params = [
            'data' => $data,
            'rows' => $rows,
            'page_count' => $count,
            'after' => $afterParam
        ];
        $this->view->render('list', $params);
    }
    public function deleteAction() : void
    {
        $params = [
            'id' => $this->request->getParam('id')
        ];
        $this->model->delete((int) $params['id']);
        $this->view->render('delete', $params);
    }
    public function showAction() : void
    {
        $id = $this->request->getParam('id');
        $params = [
            'data' => $this->model->get((int) $id)
        ];

        $this->view->render('show', $params);
    }
    public function editAction() : void
    {
            $note = $this->getNote();
            $this->view->render('edit', $note);

            if ($this->request->hasPost()) {
                $params = [
                    'id' => $this->request->getParam('id'),
                    'title' => $this->request->postParam('title'),
                    'description' => $this->request->postParam('description')
                ];
                $this->model->edit($params);
                $this->redirect(["after" => "edited"]);
            }
    }

    private function getNote() : array
    {
            $id = $this->request->getParam('id');

            return $this->model->get($id);
        }

}