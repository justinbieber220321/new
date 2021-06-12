<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Base\BackendController;
use App\Model\Entities\Category;
use App\Repositories\CategoryRepository;

class CategoryController extends BackendController
{
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->setRepository($categoryRepository);
    }

    public function index()
    {
        $this->_clearSessionForm();
        $entities = $this->getRepository()->getListForBackend();

        $viewData = [
            'entities' => $entities
        ];

        return view('backend.category.index', $viewData);
    }

    public function create()
    {
        $entity = $this->findOrNewEntityForCreate();
        $categories = $this->getRepository()->getListForBackend();

        $viewData = [
            'entity' => $entity,
            'categories' => $categories,
        ];

        return view('backend.category.create', $viewData);
    }

    public function store()
    {
        try {
            $params = request()->all();

            /** @var \App\Validators\CategoryValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->backendValidateStoreCategory($params);

            if (!$isValid) {
                $this->setFormData($params);
                return $this->_inValid($validator->errors());
            }

            $parentId = arrayGet($params, 'parent_id');
            $categoryParent = $this->getRepository()->findById($parentId);
            $params['level'] = empty($categoryParent) ? getConfig('category_level_default') : ++$categoryParent->level;
            $params['slug'] = createSlug(arrayGet($params, 'name'));
            $category = new Category();
            $category->fill($params);
            $category->save();
            return backRouteSuccess('backend.category.list', transMessage('create_success'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }

    public function edit($id)
    {
        try {
            $entity = $this->findEntityForUpdate($id);
            $categories = $this->getRepository()->getListForBackend();

            if (empty($entity)) {
                return backSystemError();
            }

            $viewData = [
                'entity' => $entity,
                'categories' => $categories,
            ];

            return view('backend.category.edit', $viewData);
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function update($id)
    {
        try {
            $params = request()->all();

            $category = $this->getRepository()->findById($id);
            if (empty($category)) {
                return backSystemError();
            }

            /** @var \App\Validators\CategoryValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->backendValidateUpdateCategory($params);

            if (!$isValid) {
                $this->setFormData($params);
                return $this->_inValid($validator->errors());
            }

            $parentId = arrayGet($params, 'parent_id');
            $categoryParent = $this->getRepository()->findById($parentId);
            $params['level'] = empty($categoryParent) ? getConfig('category_level_default') : ++$categoryParent->level;
            $category->fill($params);
            $category->save();

            return backRouteSuccess('backend.category.list', transMessage('create_success'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }

    public function destroy($id)
    {
        try {
            $category = $this->getRepository()->findById($id);
            if (empty($category)) {
                return backSystemError();
            }
            // Getting all children ids
            $childIds = $this->_getChildren($category);
            array_push($childIds, $id);
            Category::whereIn('id', $childIds)->update(['del_flag' => delFlagOff()]);
            return backSuccess(transMessage('delete_success'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }

    protected function _getChildren($category)
    {
        $ids = [];
        foreach ($category->children as $cat) {
            $ids[] = $cat->id;
            $ids = array_merge($ids, $this->_getChildren($cat));
        }
        return $ids;
    }
}
