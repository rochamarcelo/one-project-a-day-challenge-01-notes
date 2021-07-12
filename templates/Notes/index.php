<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Note[]|\Cake\Collection\CollectionInterface $notes
 * @var \App\Model\Entity\Note $newNote
 */
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
                    __('Edit'),
                    [
                        'class' => 'btn btn-link',
                        'onclick' => sprintf('NotesApp.startEdit(%s);', $note->id),
                    ]
                ) ?>
                <?= $this->Form->postLink(
                    __('Delete'),
                    [
                        'action' => 'delete',
                        $note->id
                    ],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $note->id)]
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
