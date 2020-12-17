<nav class='d-flex justify-content-center mt-3 pagination-container'>
    <ul class="pagination">
        <li class="page-item first-page">
            <a class="page-link" href="<?=$pagination['first_page']?>">First</a>
        </li>

        <li class="page-item previous-page">
            <a class="page-link" href="<?=$pagination['previous']?>">
                <span>&laquo;</span>
            </a>
        </li>

        <li class="page-item page-nr">
            <a class="page-link" href="<?=$pagination['first']?>">
                <?=$page == 1 ? 1 : ($page == $page_count ? ($page_count - 2) : ($page-1))?>
            </a>
        </li>
        <li class="page-item page-nr">
            <a class="page-link" href="<?=$pagination['second']?>">
                <?=$page == 1 ? 2 : ($page == $page_count ? ($page_count - 1) : $page)?>
            </a>
        </li>
        <li class="page-item page-nr">
            <a class="page-link" href="<?=$pagination['third']?>">
                <?=$page == 1 ? 3 : ($page == $page_count ? $page_count : ($page+1))?>
            </a>
        </li>

        <li class="page-item next-page">
            <a class="page-link" href="<?=$pagination['next']?>">
                <span>&raquo;</span>
            </a>
        </li>
        <li class="page-item last-page">
            <a class="page-link" href="<?=$pagination['last_page']?>">Last</a>
        </li>
    </ul>
</nav>