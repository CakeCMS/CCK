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

use JBZoo\Utils\Str;
use JBZoo\Utils\Arr;
use Cake\Utility\Inflector;
use Cake\Http\Client\Response;
use Cck\Model\Entity\Application;
use Cck\Model\Table\ApplicationsTable;
use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Exception\RolledbackTransactionException;

/**
 * Class ApplicationsController
 *
 * @package Cck\Controller\Admin
 * @property ApplicationsTable $Applications
 */
class ApplicationsController extends AppController
{

    /**
     * Add application action.
     *
     * @param null|string $group
     * @return Response|null
     * @throws RolledbackTransactionException|\InvalidArgumentException
     */
    public function add($group = null)
    {
        $group  = Str::low($group);
        $groups = $this->cms['helper']['cck.application']->groups();

        if (!Arr::key($group, $groups)) {
            $this->Flash->error(__d('cck', 'Not found application group.'));
            return $this->redirect(['action' => 'newApp']);
        }

        /** @var Application $app */
        $app = $this->Applications->newEntity();
        if ($this->request->is('post')) {
            $app = $this->Applications->patchEntity($app, $this->request->getData());
            if ($result = $this->Applications->save($app)) {
                $this->Flash->success(__d('cck', 'The application {0} has been saved.', sprintf(
                    '<strong>«%s»</strong>',
                    $result->get('name')
                )));
                return $this->App->redirect([
                    'apply' => ['action' => 'edit', $result->id]
                ]);
            } else {
                $this->Flash->error(__d('cck', 'The application could not been saved.'));
            }
        }

        $app->set('app_group', $group);

        $this
            ->set('app', $app)
            ->set('params', $app->getParamsForm())
            ->set('templates', $app->getTemplatesList())
            ->set('page_title', __d('cck', 'New application: {0}', Inflector::camelize($app->app_group)));
    }

    /**
     * Edit action.
     *
     * @param int $id
     * @return Response|null
     * @throws InvalidPrimaryKeyException|RecordNotFoundException|RolledbackTransactionException
     */
    public function edit($id)
    {
        $entity = $this->Applications->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $entity = $this->Applications->patchEntity($entity, $this->request->getData());
            if ($result = $this->Applications->save($entity)) {
                $this->Flash->success(__d('cck', 'The application {0} has been updated.', sprintf(
                    '<strong>«%s»</strong>',
                    $result->get('name')
                )));
                return $this->App->redirect([
                    'apply' => ['action' => 'edit', $result->id]
                ]);
            } else {
                $this->Flash->error(__d('cck', 'The application could not been updated.'));
            }
        }

        $this
            ->set('app', $entity)
            ->set('params', $entity->getParamsForm())
            ->set('templates', $entity->getTemplatesList())
            ->set('page_title', __d('cck', 'Edit application: {0}', Inflector::camelize($entity->app_group)));
    }

    /**
     * Index action.
     *
     * @return void
     */
    public function index()
    {
        $apps = $this->Applications->find();
        $this
            ->set('apps', $apps)
            ->set('page_title', __d('cck', 'List of applications'));
    }

    /**
     * Add new catalog action.
     *
     * @return void
     */
    public function newApp()
    {
        $this
            ->set('apps', $this->cms['helper']['cck.application']->groups())
            ->set('page_title', __d('cck', 'Create new application'));
    }
}
