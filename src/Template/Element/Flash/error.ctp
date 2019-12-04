<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div style="position: fixed; top: 40px; right: 40px; width: 500px; height: auto; min-height: 100px; background-color: #b84646;  color: #ffffff; z-index: 999999; text-align: center; padding: 50px; font-size: 18px;">
    <div class="message error" onclick="this.classList.add('hidden');"><?= $message ?></div>
</div>
