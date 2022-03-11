<?php

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

if ($_SESSION['user']->getRole() !== 'admin') {
    header('Location: index.php');
}

foreach ($data['users'] as $value) {
    ?>
    <div>
        <span><?= $value->getUsername() ?></span>
        <p><?= $value->getRole() ?></p>
        <a href="/index.php?c=user&a=delete-user&id=<?= $value->getId() ?>">Supprimer</a>
    </div>

    <form action="/index.php?c=user&a=user-role&id=<?= $value->getId() ?>" method="post">
        <label for="role">nouveau Role :</label>
        <select name="role" id="role">
            <option value="user">user</option>
            <option value="writer">writer</option>
            <option value="admin">admin</option>
        </select>
        <input type="submit" name="submit">
    </form>
    <?php
}
