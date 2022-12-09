// const btnOpenWd = document.querySelector('.btnSee__detail--yourOrder');
// const closenWd = document.querySelector('.over-lay');

// function toggleModal() {
//     closenWd.classList.toggle('detail_payment--success-hidden');
// }
// btnOpenWd.addEventListener('click', toggleModal);
// closenWd.addEventListener('click', toggleModal);
const btnOpenWd = document.querySelector('.btnSee__detail--yourOrder');
const modal = document.querySelector('.detail_payment--success');
const closenWd = document.querySelector('.over-lay');

function toggleModal() {
    modal.classList.toggle('detail_payment--success-hidden');
}

function toggleModal2() {
    closenWd.classList.toggle('detail_payment--success-hidden');
}
btnOpenWd.addEventListener('click', toggleModal);
closenWd.addEventListener('click', toggleModal2);


// File thừa js