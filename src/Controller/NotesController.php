<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Notes Controller
 *
 * @property \App\Model\Table\NotesTable $Notes
 * @method \App\Model\Entity\Note[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NotesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $id = null;
        $note = null;
        if ($this->request->is(['post', 'put'])) {
            $id = $this->request->getData('id');
            $note = $this->getNoteEntity($id);
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The note could not be saved. Please, try again.'));
        }
        $newNote = $id ? $note : $this->Notes->newEmptyEntity();
        $notes = $this->paginate($this->Notes, [
            'order' => [
                'Notes.modified' => 'desc',
            ]
        ]);
        $this->set(compact('notes', 'newNote'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $note = $this->Notes->get($id);
        if ($this->Notes->delete($note)) {
            $this->Flash->success(__('The note has been deleted.'));
        } else {
            $this->Flash->error(__('The note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param string|null $id
     * @return \App\Model\Entity\Note
     */
    protected function getNoteEntity($id): \App\Model\Entity\Note
    {
        if ($id !== null) {
            $note = $this->Notes->get($id);

            return $this->Notes->patchEntity(
                $note,
                $this->request->getData()
            );
        }

        return $this->Notes->newEntity(
            $this->request->getData()
        );
    }
}
