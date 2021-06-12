<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Base\BackendController;
use App\Model\Entities\Post;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;

class PostController extends BackendController
{
    protected $_categoryRepository;

    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $this->setRepository($postRepository);
        $this->_categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $this->_clearSessionForm();
        $entities = $this->getRepository()->getListForBackend();
        $categories = $this->_categoryRepository->getListForBackend();

        $viewData = [
            'entities' => $entities,
            'categories' => $categories,
        ];

        return view('backend.post.index', $viewData);
    }

    public function create()
    {
        $entity = $this->findOrNewEntityForCreate();
        $categories = $this->_categoryRepository->getListForBackend();
        $viewData = [
            'entity' => $entity,
            'categories' => $categories,
        ];

        return view('backend.post.create', $viewData);
    }

    public function store()
    {
        try {
            $params = request()->all();

            /** @var \App\Validators\PostValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->backendValidateStorePost($params);

            if (!$isValid) {
                $this->setFormData($params);
                return $this->_inValid($validator->errors());
            }

            $entity = new Post();
            $params['slug'] = createSlug(arrayGet($params, 'title'));
            $entity->fill($params);
            $entity->save();
            $this->afterStoreUpdateCommit();
            return backRouteSuccess(backendRouterName('post.list'), transMessage('create_success'));
        } catch (\Exception $e) {
            logError($e);
        }
        return backRouteError(backendRouterName('post.list'), transMessage('system_error'));
    }

    public function edit($id)
    {
        try {
            $entity = $this->findEntityForUpdate($id);
            $categories = $this->_categoryRepository->getListForBackend();

            if (empty($entity)) {
                return backSystemError();
            }

            $viewData = [
                'entity' => $entity,
                'categories' => $categories,
            ];

            return view('backend.post.edit', $viewData);
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function update($id)
    {
        try {
            $entity = $this->getRepository()->findById($id);
            if (empty($entity)) {
                return backSystemError();
            }

            $params = request()->all();

            /** @var \App\Validators\PostValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->backendValidateStorePost($params);

            if (!$isValid) {
                $this->setFormData($params);
                return $this->_inValid($validator->errors());
            }

            $entity->fill($params);
            $entity->save();
            $this->afterStoreUpdateCommit();
            return backRouteSuccess(backendRouterName('post.list'), transMessage('update_success'));
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }
}
