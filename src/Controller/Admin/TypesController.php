<?php
/**
 * CakeCMS CCK
 *
 * This file is part of the of the simple cms based on CakePHP 3.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package   CCK
 * @license   MIT
 * @copyright MIT License http://www.opensource.org/licenses/mit-license.php
 * @link      https://github.com/CakeCMS/CCK".
 * @author    Sergey Kalistratov <kalistratov.s.m@gmail.com>
 */

namespace Cck\Controller\Admin;

use Cck\Model\Entity\Type;
use Cck\Model\Table\TypesTable;

/**
 * Class TypesController
 *
 * @package Cck\Controller\Admin
 * @property TypesTable $Types
 */
class TypesController extends AppController
{

    /**
     * Ad action.
     *
     * @return \Cake\Http\Response|null
     */
    public function add()
    {
        /** @var Type $entity */
        $entity = $this->Types->newEntity();
        if ($this->request->is('post')) {
            $entity = $this->Types->patchEntity($entity, $this->request->getData());
            /** @var Type $result */
            if ($result = $this->Types->save($entity)) {
                $this->Flash->success(__d('cck', 'The type {0} has been saved.', sprintf(
                    '<strong>«%s»</strong>',
                    $result->params->get('name')
                )));

                return $this->App->redirect([
                    'apply' => ['action' => 'edit', $result->id]
                ]);
            } else {
                $this->Flash->error(__d('cck', 'The type could not been saved.'));
            }
        }

        $this
            ->set('entity', $entity)
            ->set('page_title', __d('cck', 'Create new type'));
    }

    /**
     * Edit action.
     *
     * @param null|int $id
     * @return \Cake\Http\Response|null
     */
    public function edit($id = null)
    {
        /** @var Type $entity */
        $entity = $this->Types->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $entity = $this->Types->patchEntity($entity, $this->request->getData());
            /** @var Type $result */
            if ($result = $this->Types->save($entity)) {
                $this->Flash->success(__d('cck', 'The type {0} has been updated.', sprintf(
                    '<strong>«%s»</strong>',
                    $result->params->get('name')
                )));

                return $this->App->redirect([
                    'apply' => ['action' => 'edit', $entity->id]
                ]);
            } else {
                $this->Flash->error(__d('cck', 'The type could not been updated.'));
            }
        }

        $this
            ->set('entity', $entity)
            ->set('page_title', __d('cck', 'Edit type: {0}', $entity->name));
    }

    /**
     * Index action.
     *
     * @return void
     */
    public function index()
    {
        $this
            ->set('types', $this->Types->find())
            ->set('page_title', __d('cck', 'List of types'));
    }
}
