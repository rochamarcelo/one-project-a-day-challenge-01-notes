<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Note[]|\Cake\Collection\CollectionInterface $notes
 * @var \App\Model\Entity\Note $newNote
 */
$editSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>';
$deleteSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>';
?>
<script>
    var NotesApp = (function() {
       return {
           startEdit: function(id) {
               document.getElementById('noteEdit' + id).style.display = 'block';
               document.getElementById('noteActions' + id).style.display = 'none';
           },
           cancelEdit: function(id) {
               document.getElementById('noteEdit' + id).style.display = 'none';
               document.getElementById('noteActions' + id).style.display = 'block';
           },
           startNew: function() {
               document.getElementById('newNote').style.display = 'block';
           },
           cancelNew: function() {
               document.getElementById('newNote').style.display = 'none';
               document.getElementById('iptAddNote').value = '';
               document.getElementById('iptAddTitle').value = '';
           }
       }
    })();
</script>
<div class="notes index content">
    <?= $this->Html->tag(
        'span',
        __('New Note'),
        [
            'class' => 'btn btn-primary mb-3',
            'onclick' => 'NotesApp.startNew();',
        ]
    ) ?>
    <div class="new-note" id="newNote" style="display: none">
        <div class="card mb-3">
            <div class="card-body">
        <?= $this->Form->create($newNote) ?>
        <?php
        echo $this->Form->control('title', [
            'class' => 'form-control',
            'id' => 'iptAddTitle',
            'label' => [
                'class' => 'form-label',
            ],
        ]);
        echo $this->Form->control('note', [
            'type' => 'textarea',
            'class' => 'form-control',
            'id' => 'iptAddNote',
            'label' => [
                'class' => 'form-label',
            ],
        ]);
        ?>
        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
        <?= $this->Html->tag('span', __('Cancel'), [
            'class' => 'btn btn-link',
            'onclick' => 'NotesApp.cancelNew();',
        ])?>
        <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
    <?php foreach ($notes as $note): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?= h($note->title) ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= h($note->modified) ?></h6>
                <p class="card-text"><?= h($note->note) ?></p>
                <div class="edit-note" id="noteEdit<?=$note->id?>" style="display: none;">
                    <?= $this->Form->create($note) ?>
                    <?= $this->Form->hidden('id')?>
                    <?php
                        echo $this->Form->control('title', [
                            'class' => 'form-control',
                            'label' => [
                                'class' => 'form-label',
                            ],
                        ]);
                        echo $this->Form->control('note', [
                            'type' => 'textarea',
                            'class' => 'form-control',
                            'label' => [
                                'class' => 'form-label',
                            ],
                        ]);
                    ?>
                    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
                    <?= $this->Html->tag('span', __('Cancel'), [
                        'class' => 'btn btn-link',
                        'onclick' => sprintf('NotesApp.cancelEdit(%s);', $note->id),
                    ])?>
                    <?= $this->Form->end() ?>
                </div>
                <div id="noteActions<?= $note->id?>">
                <?= $this->Html->tag(
                    'span',
                    $editSvg . __('Edit'),
                    [
                        'class' => 'btn btn-info',
                        'onclick' => sprintf('NotesApp.startEdit(%s);', $note->id),
                        'style' => 'color:white;'
                    ]
                ) ?>
                <?= $this->Form->postLink(
                    $deleteSvg . '<span>' . __('Delete') . '</span>',
                    [
                        'action' => 'delete',
                        $note->id
                    ],
                    [
                        'confirm' => __('Are you sure you want to delete # {0}?', $note->id),
                        'escapeTitle' => false,
                        'class' => 'btn btn-danger',
                    ]
                ) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
