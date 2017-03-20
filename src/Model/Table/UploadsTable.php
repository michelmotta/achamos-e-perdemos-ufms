<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Uploads Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Objects
 *
 * @method \App\Model\Entity\Upload get($primaryKey, $options = [])
 * @method \App\Model\Entity\Upload newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Upload[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Upload|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Upload patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Upload[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Upload findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UploadsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('uploads');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Objects', [
            'foreignKey' => 'object_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('file', 'create')
            ->notEmpty('file');

        $validator
            ->requirePresence('file_path', 'create')
            ->notEmpty('file_path');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['object_id'], 'Objects'));

        return $rules;
    }

    /**
     * uploadSingleFiles
     * This method receives an image and makes its upload to server's folder
     * @param $data file to be uploaded.
     * @return \Cake\Network\Response|null Redirects to index.
     */
    public function uploadUserSingleFile($data)
	{
		if (!empty($data)) {
            $filename = $data['name'];
            $file_tmp_name = $data['tmp_name'];
            $dir = WWW_ROOT . 'img' . DS . 'users';
            $allowed = array('png','jpg', 'jpeg', 'bmp');

            if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
                $this->Flash->error(__("O tipo de arquivo não é permitido."));
                return $this->redirect(['action' => 'index']);
            }elseif (is_uploaded_file($file_tmp_name)) {
                $extension = substr(strrchr($filename, '.'), 1);
                $filename = uniqid() . '.' . $extension;
                move_uploaded_file($file_tmp_name, $dir.DS.$filename);
            }
		}
		return $filename;
	}

    /**
     * uploadMultitpleObjectFiles
     *
     * @param array $data files to be uploaded.
     * @return \Cake\Network\Response|null Redirects to index.
     */
    public function uploadMultitpleObjectFiles($data)
	{
		if (!empty($data)) {
			$response = array();
			foreach ($data as $file) {
				$filename = $file['name'];
				$file_tmp_name = $file['tmp_name'];
				$dir = WWW_ROOT . 'img' . DS . 'uploads';
				$allowed = array('png','jpg', 'jpeg', 'bmp');

				if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
					$this->Flash->error(__("O tipo de arquivo não é permitido."));
                return $this->redirect(['action' => 'index']);
				}elseif (is_uploaded_file($file_tmp_name)) {
                    $extension = substr(strrchr($filename, '.'), 1);
					$filename = uniqid() . '.' . $extension;
					move_uploaded_file($file_tmp_name, $dir.DS.$filename);
					array_push($response, $filename);
				}
			}
		}
		return $response;
	}
}
