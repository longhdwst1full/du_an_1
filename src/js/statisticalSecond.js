const labels2 = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
const data2 = {
    labels: labels2,
    datasets: [{
            label: 'Adidas',
            backgroundColor: '#DD4B39',
            borderColor: '#DD4B39',
            data: [34, 27, 56, 34, 24, 53, 65, 74, 70, 71, 56, 89],
            tension: 0.4,
        },
        {
            label: 'Nike',
            backgroundColor: 'blue',
            borderColor: 'blue',
            data: [10, 20, 46, 44, 34, 63, 34, 28, 34, 80, 24, 32],
            tension: 0.4,
        },
        {
            label: 'Puma',
            backgroundColor: '#00C0EF',
            borderColor: '#00C0EF',
            data: [28, 54, 15, 34, 46, 44, 57, 23, 51, 69, 90, 21],
            tension: 0.4,
        },
    ]
}

const config2 = {
    type: 'line',
    data: data2,
};
const canvas2 = document.getElementById('chart__first2');
const chart2 = new Chart(canvas2, config2);