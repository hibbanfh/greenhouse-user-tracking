<div class="col-md-3">
            <ul class="pagination" style="margin-left:30px;">
                <li class="page-item"><?php if($page > 1): ?>
                    <a class="page-link" href="?halaman=<?= $page - 1; ?>">Previous</a>
                <?php endif; ?>
                </li>
                <?php for($i=1; $i<=$pages; $i++) :?>
                <li class="<?php if($i == $page) {echo 'page-item active';} else {echo 'page-item';} ?>">
                        <a href="?halaman=<?= $i; ?>" class="page-link"><?= $i; ?></a>
                    <?php endfor;?>  
                </li>
                <li class="page-item"><?php if($page < $pages): ?>
                    <a href="?halaman=<?= $page + 1;?>" class="page-link">Next</a>
                <?php endif; ?>
                </li>
            </ul>
</div>
