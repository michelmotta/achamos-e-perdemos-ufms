<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

   private $userId;
   private $userRole;

   /**
    * initialization method of this class
    *
    * @return \Cake\Network\Response|null
    */
   public function initialize()
   {
      parent::initialize();

      $this->userId = $this->Auth->user('id');
      $this->userRole = $this->Auth->user('role');
   }

   /**
    * beforeFilter callback method This callback method allow views to see visualized without authentication
    *
    * @return \Cake\Network\Response|null
    */
   public function beforeFilter(Event $event)
   {
      $this->Auth->allow(['display', 'home', 'restApi']);
   }

    /**
     * Displays a view home page
     *
     * @param string ...$path Path segments.
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display(...$path)
    {
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }

        $this->loadModel('Objects');
        $objects = $this->Objects->find('all')
            ->where(['solved' => 0])
            ->contain(['Users', 'Categories', 'Comments', 'Uploads'])
            ->order(['Objects.id' => 'DESC'])
            ->limit(3);

        $this->set('objects', $objects);

        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }

    /**
    * Displays a view dashboard admin page
    *
    * @return void|\Cake\Network\Response
    * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
    * @throws \Cake\Network\Exception\NotFoundException When the view file could not
    *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
    */
   public function dashboard()
   {

      $this->loadModel('Objects');
      $this->loadModel('Comments');
      if($this->userRole == 'admin'){

         $allCountObjects = $this->Objects
         ->find()
         ->contain(['Users'])
         ->count();

         $this->set('allCountObjects', $allCountObjects);

         $allCountComments = $this->Comments
         ->find()
         ->contain(['Objects'])
         ->count();

          $this->set('allCountComments', $allCountComments);
      }else{
          $allCountObjects = $this->Objects
             ->find()
             ->contain(['Users'])
             ->where(['user_id' => $this->userId])
             ->count();

          $this->set('allCountObjects', $allCountObjects);

          $allCountComments = $this->Comments
          ->find()
          ->contain(['Objects'])
          ->where(['user_id' => $this->userId])
          ->count();

           $this->set('allCountComments', $allCountComments);
      }

      //$this->loadModel('Comments');
      //$allCountComments = $this->Comments->find('all')->count();
      //$this->set('allCountComments', $allCountComments);
   }

   /**
   * Displays a view restApi page with frontend layout
   *
   * @return void|\Cake\Network\Response
   * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
   * @throws \Cake\Network\Exception\NotFoundException When the view file could not
   *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
   */
   public function restApi()
   {
        $this->viewBuilder()->setLayout('frontend');
   }
}
