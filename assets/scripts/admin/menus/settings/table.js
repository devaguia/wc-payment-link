export default class Table
{
    constructor() {
        this.orderTable();
        this.paginationTable();
    }

    orderTable() {
        const ancors = document.querySelectorAll('.order-table');
        const urlParams = new URLSearchParams(window.location.search);
        let sortOrder = urlParams.get('order') || 'DESC';

        ancors.forEach((ancor) => {
            const value = ancor.getAttribute('data-order');
            if (value) {
                ancor.addEventListener('click', () => {
                    sortOrder = sortOrder === 'ASC' ? 'DESC' : 'ASC';
                    this.queryURL([{"key": "orderby", "value": value}, {"key": "order", "value": sortOrder}]);
                })
            }
        })
    }
    paginationTable() {
        const ancors = document.querySelectorAll('.pagination');

        ancors.forEach((ancor) => {
            const value = ancor.getAttribute('data-page');
            if (value) {
                ancor.addEventListener('click', () => {
                    this.queryURL([{"key": "table-page", "value": value}]);
                })
            }
        })
    }

    queryURL(paramsArray) {
        const urlParams = new URLSearchParams(window.location.search);

        paramsArray.forEach(({ key, value }) => {
            urlParams.delete(key);
            urlParams.append(key, value);
        });

        window.location.replace(`${location.origin + location.pathname}?${urlParams.toString()}`);
    }
}
