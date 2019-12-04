<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div style="position: fixed; top: 40px; right: 40px; width: 500px; height: auto; min-height: 100px; background-color: #0b93d5;  color: #ffffff; z-index: 999999; text-align: center; padding: 50px; font-size: 18px;">
    <div class="<?= h($class) ?>" onclick="this.classList.add('hidden');"><?= $message ?>
    </div>
</div>
