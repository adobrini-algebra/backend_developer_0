<?php if (!empty($message)): ?>
<div class="alert alert-<?= $message['type'] ?> alert-dismissible fade show" role="alert">
    <?= $message['message'] ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>  