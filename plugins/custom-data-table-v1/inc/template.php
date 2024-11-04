<? get_header(); ?>

<? pageBanner(array(
    'title' => 'custom data table',
    'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta!'
)); ?>

<main>
    <div id="main-box">

        <?php

            require_once plugin_dir_path(__FILE__) . 'PetsQuery.php';
            $petsQuery = new PetsQuery();
        ?>

        <? if(current_user_can('administrator')): ?>
            <form class="create-pet-form" action="<?= esc_url(admin_url('admin-post.php')) ?>" method="POST">
                <p>create new pet</p>
                <input type="hidden" name="count" value="<?= $petsQuery->count ?>" />
                <input type="hidden" name="action" value="createPet" />
                <input type="text" name="petname" />
                <button type="submit">add pet</button>
            </form>
        <? endif; ?>

        <table class="pet-adoption-table">
            <tr>
                <th>birth year</th>
                <th>pet weight</th>
                <th>fav food</th>
                <th>fav color</th>
                <th>pet name</th>
                <? if(current_user_can('administrator')): ?>
                    <th>Delete</th>
                <? endif; ?>
            </tr>
            <? foreach($petsQuery->pets as $pet): ?>
                <tr>
                    <td><?= $pet->birthyear ?></td>
                    <td><?= $pet->petweight ?></td>
                    <td><?= $pet->favfood ?></td>
                    <td><?= $pet->favcolor ?></td>
                    <td><?= $pet->petname ?></td>
                    <td>
                        <form action="<?= esc_url(admin_url('admin-post.php')) ?>" method="POST">
                            <input type="hidden" name="action" value="deletePet" />
                            <input type="hidden" name="id" value="<?= $pet->id ?>" />
                            <button type="submit">X</button>
                        </form>
                    </td>
                </tr>
            <? endforeach; ?>
        </table>
    </div>
</main>

<? get_footer(); ?>