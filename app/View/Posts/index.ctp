<h1>Blog posts</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Content</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id_post']; ?></td>
        <td><?php echo $post['Post']['titre']; ?></td>
        <td><?php echo $post['Post']['contenu']; ?></td>
        <td><?php echo $post['Post']['date']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>