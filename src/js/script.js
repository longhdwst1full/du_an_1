const chooseInputAll = document.getElementsByTagName('input');
const btnRemoveAll = document.querySelector('.btn-deleteAll');
const allProduct = document.querySelector('#Allproduct');
let flagChooseInput = 0;
allProduct.addEventListener('click', function() {
    flagChooseInput++;
    if (flagChooseInput % 2 != 0) {
        for (let i = 1; i < chooseInputAll.length; i++) {
            chooseInputAll[i].checked = true;
        }
    } else {
        for (let i = 1; i < chooseInputAll.length; i++) {
            chooseInputAll[i].checked = false;
        }
    }
});