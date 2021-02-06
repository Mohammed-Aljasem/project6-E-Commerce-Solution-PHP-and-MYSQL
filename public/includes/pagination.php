<div class="col-lg-12" style="display: flex; justify-content: center">
    <nav class="">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="?pageno=1"> &#171; </a></li>
            <li class="page-item <?php if ($pageno <= 1) {
                echo 'disabled';
            } ?>">
                <a class="page-link" href="<?php if ($pageno <= 1) {
                    echo '#';
                } else {
                    echo "?pageno=" . ($pageno - 1);
                } ?>"> &#8249; </a>
            </li>
            <li class="page-item <?php if ($pageno >= $total_pages) {
                echo 'disabled';
            } ?>">
                <a class="page-link" href="<?php if ($pageno >= $total_pages) {
                    echo '#';
                } else {
                    echo "?pageno=" . ($pageno + 1);
                } ?>">&#8250; </a>
            </li>
            <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>"> &#187; </a></li>
        </ul>
    </nav>
</div>