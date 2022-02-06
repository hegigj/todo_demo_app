<nav class="d-flex justify-content-center p-2">
    <ul class="pagination">
        <li class="page-item">
            <a id="previous" class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li class="page-item"><a class="page-link" href="?pageNo=1">1</a></li>
        <li class="page-item"><a class="page-link" href="?pageNo=2">2</a></li>
        <li class="page-item"><a class="page-link" href="?pageNo=3">3</a></li>
        <li class="page-item"><a class="page-link" href="?pageNo=4">4</a></li>
        <li class="page-item"><a class="page-link" href="?pageNo=5">5</a></li>
        <li class="page-item">
            <a id="next" class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
<script>
    if (queryParams) {
        const pageItems = document.getElementsByClassName('page-link');
        const parseToSearch = (query) => {
          return '?' + Object
              .keys(query)
              .reduce((acc, key, index) => {
                  if (index === 0) {
                      return acc + `${key}=${query[key]}`;
                  }
                  return acc + `&${key}=${query[key]}`;
              }, '');
        }
        for (let i = 0; i < pageItems.length; i++) {
            const [url, paginatorSearch] = pageItems.item(i).href.split(/\?|#/);
            let paginatorQuery = paginatorSearch
                .split('&')
                .reduce((acc, curr) => {
                    const [key, value] = curr.split('=');
                    return { ...acc, [key]: value };
                }, {});
            paginatorQuery = {
                ...queryParams,
                ...paginatorQuery
            };
            if (pageItems.item(i).id === 'previous' || pageItems.item(i).id === 'next') {
                let pageNo = paginatorQuery['pageNo'];

                if (pageItems.item(i).id === 'previous') {
                    pageNo = pageNo ? +pageNo > 1 ? +pageNo : 2 : 2;
                    pageItems.item(i).href = url + parseToSearch({ ...paginatorQuery, pageNo: pageNo - 1});
                } else {
                    pageNo = pageNo ? +pageNo : 1;
                    pageItems.item(i).href = url + parseToSearch({ ...paginatorQuery, pageNo: pageNo + 1});
                }
            } else {
                pageItems.item(i).href = parseToSearch(paginatorQuery);
            }
        }
    }
</script>