<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Note[]|\Cake\Collection\CollectionInterface $notes
 */
?>
<div class="notes index content">
    <?= $this->Html->link(
        __('New Note'),
        ['action' => 'add'],
        ['class' => 'btn btn-primary mb-3']
    ) ?>
    <?php foreach ($notes as $note): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?= h($note->title) ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= h($note->modified) ?></h6>
                <p class="card-text"><?= h($note->note) ?></p>
                <?= $this->Html->link(
                    __('Edit'),
                    ['action' => 'edit', $note->id]
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
    <?php endforeach; ?>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
