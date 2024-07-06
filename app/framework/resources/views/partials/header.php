<h2> Bem vindo
<?php if($this->session('logged')): ?>
    <?= $this->session('user')->firstName; ?>
<?php endif; ?>
</h2>