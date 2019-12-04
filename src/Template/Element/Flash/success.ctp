<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div style="position: fixed; top: 40px; right: 40px; width: 500px; height: auto; min-height: 100px; background-color: #008d4c;  color: #ffffff; z-index: 999999; text-align: center; padding: 50px; font-size: 18px;">
    <div class="message success" onclick="this.classList.add('hidden')"><?= $message ?></div>
</div>

